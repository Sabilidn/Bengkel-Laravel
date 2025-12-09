<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Livewire\Component;

class TransactionPrint extends Component
{
    public $transaction_details_id,$nama_item,$jenis,$qty,$harga,$total;
    public $transaction_id,$user_id,$member_id,$plat_nomor,$jenis_kendaraan,$jenis_transaksi,$product_id,$service_id,$bayar,$metode_bayar;

    public function mount($id)
    {
        $transaction_details = TransactionDetail::find($id);
        $this->transaction_details_id = $transaction_details -> id;
        $this->nama_item = $transaction_details->nama_item;
        $this->jenis = $transaction_details->jenis;
        $this->qty = $transaction_details->qty;
        $this->harga = $transaction_details->harga;
        $this->total = $transaction_details->total;

        $transaction = Transaction::find($id);
        $this->transaction_id = $transaction->id;
        $this->user_id = $transaction->user_id;
        $this->member_id = $transaction->member_id;
        $this->plat_nomor = $transaction->plat_nomor;
        $this->jenis_kendaraan = $transaction->jenis_kendaraan;
        $this->jenis_transaksi = $transaction->jenis_transaksi;
        $this->product_id = $transaction->product_id;
        $this->service_id = $transaction->service_id;
        $this->bayar = $transaction->bayar;
        $this->metode_bayar = $transaction->metode_bayar;

    }
    public function render()
    {
        return view('livewire.admin.transaction.transaction-print', [
            'transaction' => Transaction::find($this->transaction_id),
            'details' => TransactionDetail::find($this->transaction_details_id),
        ]);
    }
}
