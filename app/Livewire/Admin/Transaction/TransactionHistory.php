<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class TransactionHistory extends Component
{
    public function render()
    {
        return view('livewire.admin.transaction.transaction-history', [
            'transaction' => Transaction::where('user_id', auth()->id())->paginate(10)
        ]);
    }
}
