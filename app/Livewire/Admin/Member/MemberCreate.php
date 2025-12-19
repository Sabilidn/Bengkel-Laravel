<?php

namespace App\Livewire\Admin\Member;

use App\Models\Member;
use Livewire\Component;

class MemberCreate extends Component
{
    public $nama, $nomor_handphone, $plat_nomor, $jenis_kendaraan;

    protected $rules = [
        'nama' => 'required|string|max:100|unique:members,nama',
        'nomor_handphone' => 'required|max:15',
        'plat_nomor' => 'required|max:15',
        'jenis_kendaraan' => 'required|max:20',
    ];

    public function save()
    {
        try {
            $this->validate();

            Member::create([
                'nama' => $this->nama,
                'nomor_handphone' => $this->nomor_handphone,
                'plat_nomor' => $this->plat_nomor,
                'jenis_kendaraan' => $this->jenis_kendaraan,
            ]);

            toastr()->success('Berhasil Tambah Data');
            $this->reset('nama', 'nomor_handphone');
            return redirect()->route('member.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
            if ($errors->has('nama')) {
                toastr()->warning('Nama sudah terdaftar. Gunakan nama lain.');
                return redirect()->route('member.index');
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.member.member-create');
    }
}
