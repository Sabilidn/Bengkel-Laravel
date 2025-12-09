<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $categoryId;
    public $nama;

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->nama = $category->nama;
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:100',
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'nama' => $this->nama,
        ]);

        toastr()->success ( 'Data berhasil diperbarui.');
        return redirect()->route('category.index');
    }
    public function render()
    {
        return view('livewire.admin.category.category-edit');
    }
}
