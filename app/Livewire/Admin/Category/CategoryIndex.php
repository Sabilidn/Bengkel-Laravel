<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;
    public $categories;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->categories = Category::latest()->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-alert', id: $id); // trigger SweetAlert di JS
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            $this->categories = Category::latest()->get(); // Refresh data
            $this->dispatch('deleted'); // trigger SweetAlert sukses
        }
    }
    public function render()
    {
        return view('livewire.admin.category.category-index', [
            'categorys' => Category::where('nama', 'like', '%' . $this->search . '%')->orderBy('created_at', 'desc') // urutkan dari yang terbaru
                ->paginate(10)
        ]);
    }
}
