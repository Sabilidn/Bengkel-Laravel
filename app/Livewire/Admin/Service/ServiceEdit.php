<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceEdit extends Component
{
    public $serviceId,$nama,$harga;

    protected $rules = [
        'nama' => 'required|string|max:100',
        'harga' => 'required'
    ];

    public function mount($id)
    {
        $service = Service::find($id);
        $this->serviceId = $service->id;
        $this->nama = $service->nama;
        $this->harga = $service->harga;
    }

    public function update()
    {
        $this->validate();
        $service = Service::find($this->serviceId);
        $service->update([
            'nama' => $this->nama,
            'harga' => $this->harga
        ]);
        if(!$service){
            toastr()->error('Data Tidak Valid');
            return redirect()->back();
        }

        toastr()->success('Data Berhasil Diubah');
        return redirect()->route('service.index');
    }
    public function render()
    {
        return view('livewire.admin.service.service-edit');
    }
}
