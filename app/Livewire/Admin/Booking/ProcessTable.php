<?php

namespace App\Livewire\Admin\Booking;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessTable extends Component
{
    use WithPagination;

    public function endBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => 'Selesai'
        ]);

        return redirect()->route('booking.end')->with('success', 'Berhasil Konfirmasi Booking');
    }
    public function render()
    {
        return view('livewire.admin.booking.process-table', [
            'booking' => Booking::where('status', 'Sedang Dikerjakan')->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
