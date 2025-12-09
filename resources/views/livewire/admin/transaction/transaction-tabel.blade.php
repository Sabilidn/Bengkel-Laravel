<div>
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3>Kasir <i class="fas fa-cash-register"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Transaksi <i
                                    class="fas fa-caret-right"></i> Kasir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid py-4">
                <!-- Informasi Pelanggan & Kendaraan -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="bi bi-person-lines-fill me-2"></i>Informasi Pelanggan & Kendaraan
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label">Nama Pelanggan</label>
                                <select wire:model.live="member_id" class="form-select form-select-sm shadow-sm">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($member as $members)
                                        <option value="{{ $members->id }}">{{ $members->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-label">No. Polisi</label>
                                <input type="text" class="form-control form-control-sm shadow-sm"
                                    placeholder="Contoh: BH 1234 AB" value="{{ $selectedMember?->plat_nomor }}" readonly>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <input type="text" class="form-control form-control-sm shadow-sm"
                                    placeholder="Contoh: Toyota" value="{{ $selectedMember?->jenis_kendaraan }}"
                                    readonly>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tambah Produk / Jasa Service -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header bg-success text-white fw-bold">
                        <i class="bi bi-cart-plus me-2"></i>Tambah Produk / Jasa Service
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-end">
                            <div class="col-12 col-md-2">
                                <label class="form-label">Jenis</label>
                                <select wire:model.live="jenis_transaksi" class="form-select form-select-sm shadow-sm">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Produk">Produk</option>
                                    <option value="Service">Service</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Nama Item</label>
                                @if ($jenis_transaksi === 'Produk')
                                    <select wire:model="product_id" class="form-select form-select-sm shadow-sm">
                                        <option value="">Pilih Produk</option>
                                        @foreach ($product as $p)
                                            @if ($p->stok > 0)
                                                <option value="{{ $p->id }}">{{ $p->nama }} - Rp
                                                    {{ number_format($p->harga, 0, '.') }} | Stok :
                                                    {{ $p->stok }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @elseif($jenis_transaksi === 'Service')
                                    <select wire:model="service_id" class="form-select form-select-sm shadow-sm">
                                        <option value="">Pilih Jasa</option>
                                        @foreach ($service as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }} -
                                                {{ number_format($s->harga, 0, '.') }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-select form-select-sm shadow-sm" disabled>
                                        <option>Pilih jenis terlebih dahulu</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-6 col-md-2">
                                <label class="form-label">Qty</label>
                                <input type="number" wire:model="qty" class="form-control form-control-sm shadow-sm"
                                    min="1">
                            </div>
                            <div class="col-6 col-md-2 d-grid">
                                <button wire:click="tambahKeKeranjang" type="button"
                                    class="btn btn-outline-primary btn-sm shadow-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keranjang -->
        <div class="card mb-4 shadow-lg border-0">
            <div class="card-header bg-secondary text-white">
                <i class="bi bi-basket-fill me-2"></i>Detail Keranjang
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered m-0 align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Jenis</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($keranjang as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['jenis'] }}</td>
                                    <td>
                                        @if ($item['jenis'] === 'Produk')
                                            <div class="input-group input-group-sm">
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    wire:click="kurangiQtyItem({{ $loop->index }})">−</button>
                                                <input type="text" class="form-control text-center"
                                                    value="{{ $item['qty'] }}" readonly>
                                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                                    wire:click="tambahQtyItem({{ $loop->index }})">+</button>
                                            </div>
                                        @else
                                            <input type="text" class="form-control text-center"
                                                value="{{ $item['qty'] }}" readonly>
                                        @endif
                                    </td>
                                    <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($item['total'], 0, ',', '.') }}</td>
                                    <td>
                                        <button type="button" wire:click="hapusItem({{ $index }})"
                                            class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-wallet2 me-2"></i>Pembayaran
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Total Tagihan</label>
                        <input type="text" class="form-control shadow-sm fw-bold"
                            value="Rp {{ number_format($subtotal, 0, ',', '.') }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jumlah Bayar</label>
                        <input type="text" id="bayar" wire:model="bayar" class="form-control shadow-sm"
                            placeholder="Masukkan jumlah bayar" onkeyup="formatRupiah(this)">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pilih Metode Pembayaran</label>
                        <div class="d-flex gap-3">
                            <button type="button" wire:click="bayarCash" class="btn btn-primary shadow">
                                <i class="bi bi-cash-coin me-1"></i> Bayar Cash
                            </button>

                            <button type="button" wire:click="$toggle('showDebitForm')"
                                class="btn btn-warning shadow">
                                <i class="bi bi-credit-card-2-front-fill me-1"></i> Bayar Debit
                            </button>
                        </div>
                    </div>
                </div>



                @if ($showDebitForm)
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label class="form-label">Nama Bank</label>
                            <select wire:model="nama_bank" class="form-select shadow-sm">
                                <option value="">Pilih Bank</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nomor ATM</label>
                            <input type="text" class="form-control shadow-sm" wire:model="nomor_rekening"
                                placeholder="Contoh: 1234-5678-XXXX">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nominal Debit</label>
                            <input type="number" class="form-control shadow-sm" wire:model="nominal_debit"
                                placeholder="Masukkan nominal debit">
                        </div>

                        <div class="d-grid mt-3">
                            <button type="button" wire:click="bayarDebit" class="btn btn-success btn-lg shadow">
                                <i class="bi bi-save2 me-2"></i>Simpan Transaksi Debit
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
<!-- Informasi Pelanggan & Kendaraan -->

<script>
    function formatRupiah(input) {
        // Ambil nilai tanpa "Rp" dan titik
        let angka = input.value.replace(/[^,\d]/g, '').toString();
        if (!angka) {
            input.value = '';
            return;
        }
        let split = angka.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = 'Rp ' + rupiah;

        // Update Livewire model tanpa Rp dan titik
        @this.set('bayar', angka);
    }
</script>

</div>
