<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Member;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;

class TransactionTabel extends Component
{
    public $member_id, $plat_nomor, $jenis_kendaraan;
    public $jenis_transaksi, $product_id, $service_id, $invoice, $qty = 1, $harga = 0, $bayar, $metode_bayar, $nama_bank, $nomor_rekening, $nominal_debit;
    public $showDebitForm = false;

    public $keranjang = [];
    public $subtotal = 0;
    public $total_item = 0;

    public $total;

    public $selectedMember;


    protected $rules = [
        'user_id'         => 'nullable|exists:users,id',
        'member_id'       => 'nullable|exists:members,id',
        'jenis_transaksi' => 'required|in:barang,jasa,gabungan',
        'product_id'      => 'nullable|exists:products,id',
        'service_id'      => 'nullable|exists:services,id',
        'qty'             => 'required|integer|min:1',
        'invoice'           => 'required|string',
        'total'           => 'required|numeric|min:0',
        'bayar'           => 'nullable|numeric|min:0',
        'kembalian'       => 'nullable|string|max:100',
        'metode_bayar'    => 'required|in:Cash,Debit',
        'nama_bank'       => 'nullable|string|max:100',
        'nomor_rekening'  => 'nullable|string|max:30',
        'nominal_debit'   => 'nullable|numeric|min:0',
    ];

    public function updatedMemberId($value)
    {
        $this->selectedMember = Member::find($value);
    }
    public function updatedJenisTransaksi($value)
    {
        $this->reset(['product_id', 'service_id', 'harga', 'qty', 'total']);
    }

    public function updatedProductId()
    {
        if ($this->jenis_transaksi === 'Produk') {
            $product = Product::find($this->product_id);
            $this->harga = $product?->harga ?? 0;
            $this->updateTotal();
        }
    }

    public function updatedServiceId()
    {
        if ($this->jenis_transaksi === 'Service') {
            $service = Service::find($this->service_id);
            $this->harga = $service?->harga ?? 0;
            $this->updateTotal();
        }
    }

    public function updatedQty()
    {
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total = $this->harga * $this->qty;
    }
    public function tambahKeKeranjang()
    {
        if ($this->jenis_transaksi === 'Produk') {
            $item = Product::find($this->product_id);
            $id = $this->product_id;
        } elseif ($this->jenis_transaksi === 'Service') {
            $item = Service::find($this->service_id);
            $id = $this->service_id;
        } else {
            toastr()->warning('Jenis transaksi belum dipilih.');
            return;
        }

        if (!$item) {
            toastr()->warning('Item tidak ditemukan.');
            return;
        }

        $nama = $item->nama;
        $harga = $item->harga;

        // Cek apakah item sudah ada di keranjang
        $itemIndex = collect($this->keranjang)->search(function ($val) use ($id) {
            return $val['id'] === $id && $val['jenis'] === $this->jenis_transaksi;
        });

        $stok = $item->stok ?? null; // Pastikan produk memiliki kolom stok

        $qtyRequest = $this->qty;
        $qtyInCart = ($itemIndex !== false) ? $this->keranjang[$itemIndex]['qty'] : 0;

        // Total qty yang diminta setelah ditambahkan
        $totalQty = $qtyRequest + $qtyInCart;

        if ($this->jenis_transaksi === 'Produk' && $stok !== null && $totalQty > $stok) {
            toastr()->warning('Stok tidak mencukupi!');
            return;
        }

        if ($itemIndex !== false) {
            $this->keranjang[$itemIndex]['qty'] += $this->qty;
            $this->keranjang[$itemIndex]['total'] = $this->keranjang[$itemIndex]['qty'] * $harga;
        } else {
            $this->keranjang[] = [
                'id' => $id,
                'nama' => $nama,
                'jenis' => $this->jenis_transaksi,
                'qty' => $this->qty,
                'harga' => $harga,
                'total' => $this->qty * $harga,
            ];
        }

        $this->calculateSubtotal();

        // Reset input
        $this->product_id = null;
        $this->service_id = null;
        $this->qty = 1;
    }


    public function calculateSubtotal()
    {
        $this->subtotal = array_reduce($this->keranjang, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['qty']);
        }, 0);

        $this->total_item = count($this->keranjang);
    }

    public function tambahQtyItem($index)
    {
        if (isset($this->keranjang[$index])) {
            $this->keranjang[$index]['qty'] += 1;
            $this->keranjang[$index]['total'] = $this->keranjang[$index]['qty'] * $this->keranjang[$index]['harga'];
            $this->calculateSubtotal();
        }
    }

    public function kurangiQtyItem($index)
    {
        if (isset($this->keranjang[$index]) && $this->keranjang[$index]['qty'] > 1) {
            $this->keranjang[$index]['qty'] -= 1;
            $this->keranjang[$index]['total'] = $this->keranjang[$index]['qty'] * $this->keranjang[$index]['harga'];
            $this->calculateSubtotal();
        }
    }


    public function hapusItem($index)
    {
        unset($this->keranjang[$index]);
        $this->keranjang = array_values($this->keranjang); // reindex
        $this->calculateSubtotal();
    }

    public function resetForm()
    {
        $this->member_id = null;
        $this->plat_nomor = null;
        $this->jenis_kendaraan = null;
        $this->jenis_transaksi = null;
        $this->product_id = null;
        $this->service_id = null;
        $this->qty = 1;

        $this->bayar = null;
        $this->keranjang = [];
        $this->showDebitForm = false;
        $this->nomor_rekening = null;
        $this->nominal_debit = null;
        $this->nama_bank = null;
    }


    public function bayarCash()
    {
        if (empty($this->keranjang)) {
            session()->flash('error', 'Keranjang masih kosong.');
            return;
        }

        if ($this->bayar < $this->subtotal) {
            session()->flash('error', 'Jumlah bayar kurang dari total tagihan.');
            return;
        }

        // Cek jenis transaksi dari isi keranjang
        $hasProduk = collect($this->keranjang)->contains('jenis', 'Produk');
        $hasService = collect($this->keranjang)->contains('jenis', 'Service');

        if ($hasProduk && $hasService) {
            $jenisTransaksi = 'Produk & Service';
        } elseif ($hasProduk) {
            $jenisTransaksi = 'Produk';
        } elseif ($hasService) {
            $jenisTransaksi = 'Service';
        } else {
            $jenisTransaksi = '-';
        }

        // Generate invoice number
        $today = Carbon::now()->format('Ymd');
        $lastInvoice = Transaction::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastInvoice && Str::startsWith($lastInvoice->invoice, 'INV-' . $today)) {
            $lastNumber = (int)substr($lastInvoice->invoice, -4);
            $nextNumber = $lastNumber + 1;
        }

        $invoiceNumber = 'INV-' . $today . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Simpan transaksi
        $transaksi = Transaction::create([
            'user_id' => auth()->id(),
            'member_id' => $this->member_id,
            'jenis_transaksi' => $jenisTransaksi, // <- dari hasil deteksi isi keranjang
            'invoice' => $invoiceNumber,
            'total' => $this->subtotal,
            'bayar' => $this->bayar,
            'qty' => $this->qty,
            'kembalian' => $this->bayar - $this->subtotal,
            'metode_bayar' => 'Cash',
        ]);

        if (!$transaksi) {
            toastr()->error('Mohon isi dengan lengkap data-nya');
            return redirect()->route('transaction.index');
        }

        // Simpan detail item dan update stok produk jika perlu
        foreach ($this->keranjang as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'nama_item' => $item['nama'],
                'jenis' => $item['jenis'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'total' => $item['total'],
            ]);

            if ($item['jenis'] === 'Produk') {
                $produk = Product::find($item['id']);
                if ($produk) {
                    $produk->decrement('stok', $item['qty']);
                }
            }
        }

        $this->resetForm();
        toastr()->success('Transaksi cash berhasil disimpan.');
        return redirect()->route('transaction.print', ['id' => $transaksi->id]);
    }


    public function bayarDebit()
    {
        if (empty($this->keranjang)) {
            session()->flash('error', 'Keranjang masih kosong.');
            return;
        }

        if ($this->nominal_debit < $this->subtotal) {
            session()->flash('error', 'Nominal debit kurang dari total tagihan.');
            return;
        }

        if (empty($this->nomor_rekening) || empty($this->nama_bank)) {
            session()->flash('error', 'Mohon isi nama bank dan nomor ATM.');
            return;
        }

        // Generate invoice number
        $today = Carbon::now()->format('Ymd');
        $lastInvoice = Transaction::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastInvoice && Str::startsWith($lastInvoice->invoice, 'INV-' . $today)) {
            $lastNumber = (int)substr($lastInvoice->invoice, -4);
            $nextNumber = $lastNumber + 1;
        }

        $invoiceNumber = 'INV-' . $today . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Simpan transaksi
        $total = collect($this->keranjang)->sum('total');

        $transaksi = Transaction::create([
            'user_id' => auth()->id(),
            'member_id' => $this->member_id,
            'jenis_transaksi' => $this->jenis_transaksi,
            'invoice' => $invoiceNumber,
            'total' => $total,
            'nominal_debit' => $this->nominal_debit,
            'qty' => $this->qty,
            'metode_bayar' => 'Debit',
            'nama_bank' => $this->nama_bank,
            'nomor_rekening' => $this->nomor_rekening,
        ]);

        if (!$transaksi) {
            toastr()->error('Mohon isi dengan lengkap data-nya');
            return redirect()->route('transaction.index');
        }

        foreach ($this->keranjang as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaksi->id,
                'nama_item' => $item['nama'],
                'jenis' => $item['jenis'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'total' => $item['total'],
            ]);

            if ($item['jenis'] === 'Produk') {
                $produk = Product::find($item['id']);
                if ($produk) {
                    $produk->decrement('stok', $item['qty']);
                }
            }
        }

        $this->resetForm();
        toastr()->success('Transaksi debit berhasil disimpan.');
        return redirect()->route('transaction.print', ['id' => $transaksi->id]);
    }




    public function render()
    {
        return view('livewire.admin.transaction.transaction-tabel', [
            'member' => Member::all(),
            'product' => Product::all(),
            'service' => Service::all()
        ]);
    }
}
