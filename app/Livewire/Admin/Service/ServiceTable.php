<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceTable extends Component
{
    use WithPagination;
    public $service;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->service = Service::latest()->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-alert', id: $id);
    }
    public function delete($id)
    {
        $service = Service::find($id);
        if ($service) {
            $service->delete();
            $this->service = Service::latest()->get();
            $this->dispatch('deleted');
        }
    }
    public function render()
    {
        return view('livewire.admin.service.service-table', [
            'services' => Service::where('nama', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
