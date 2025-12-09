<?php

namespace App\Livewire\Admin\Booking;

use App\Models\Booking;
use Livewire\Component;

class EndTable extends Component
{
    public function render()
    {
        return view('livewire.admin.booking.end-table', [
            'booking' => Booking::where('status', 'Selesai')->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
