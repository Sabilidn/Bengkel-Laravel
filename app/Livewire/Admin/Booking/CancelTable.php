<?php

namespace App\Livewire\Admin\Booking;

use App\Models\Booking;
use Livewire\Component;

class CancelTable extends Component
{
    public function render()
    {
        return view('livewire.admin.booking.cancel-table', [
            'booking' => Booking::where('status', 'Dibatalkan') ->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)

        ]);
    }
}
