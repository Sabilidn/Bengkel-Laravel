<?php

namespace App\Livewire\Users;

use App\Models\Booking as ModelsBooking;
use App\Models\Member;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Booking extends Component
{
    public $nama, $nomor_hp, $email, $tipe_kendaraan, $plat_nomor, $atas_nama;
    public $jadwal_service, $tipe_service, $tipe_service_lainnya, $keluhan;

    public function submitBooking()
    {
        $this->validate([
            'nama' => 'required|string|min:3|max:50',
            'nomor_hp' => 'required|digits_between:10,15',
            'email' => 'required|email|max:100',
            'tipe_kendaraan' => 'required|string|max:30',
            'plat_nomor' => 'required|string|min:5|max:10',
            'atas_nama' => 'required|string|min:3|max:50',
            'jadwal_service' => 'required|date',
            'tipe_service' => 'required|string',
            'tipe_service_lainnya' => 'required_if:tipe_service,Lainnya|max:50',
            'keluhan' => 'nullable|string|max:255',
        ]);

        try {
            ModelsBooking::create([
                'nama' => $this->nama,
                'nomor_hp' => $this->nomor_hp,
                'email' => $this->email,
                'tipe_kendaraan' => $this->tipe_kendaraan,
                'plat_nomor' => $this->plat_nomor,
                'atas_nama' => $this->atas_nama,
                'jadwal_service' => $this->jadwal_service,
                'tipe_service' => $this->tipe_service === 'Lainnya' ? $this->tipe_service_lainnya : $this->tipe_service,
                'keluhan' => $this->keluhan,
                'status' => 'Menunggu Konfirmasi'
            ]);

            $this->reset();
            session()->flash('success', 'Booking berhasil. Silakan datang ke bengkel.');
            return redirect()->route('booking');
        } catch (Exception $e) {
            Log::error('Gagal menyimpan booking: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data booking. Silakan coba lagi nanti.');
            return redirect()->route('booking');
        }
    }


    public function render()
    {
        return view('livewire.users.booking')->layout('components.layouts.users');
    }
}
