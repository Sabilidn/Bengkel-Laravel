<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $product;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman 1 saat search berubah
    }

    public function mount()
    {
        $this->product = Product::latest()->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-alert', id: $id); // trigger SweetAlert di JS
    }

    public function delete($id)
    {
        $category = Product::find($id);
        if ($category) {
            $category->delete();
            $this->product = Product::latest()->get(); // Refresh data
            $this->dispatch('deleted'); // trigger SweetAlert sukses
        }
    }
    public function render()
    {
        return view('livewire.admin.product.product-table', [
            'products' => Product::where('nama', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
