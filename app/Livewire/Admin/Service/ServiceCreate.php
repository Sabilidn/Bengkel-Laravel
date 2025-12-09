<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceCreate extends Component
{
    public $nama,$harga;

    protected $rules = [
        'nama' => 'required|string|max:100',
        'harga' => 'required'
    ];

    public function save()
    {
        $this->validate();
        Service::create([
            'nama' =>$this->nama,
            'harga' =>$this->harga,
        ]);

        toastr()->success('Berhasil Tambah Data');
        $this->reset('nama','harga');
        return redirect()->route('service.index');

    }
    public function render()
    {
        return view('livewire.admin.service.service-create');
    }
}
