<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Livewire\Component;

class CategoryCreate extends Component
{
    use HasFactory;
    public $nama;
    protected $rules =[
        'nama' =>'required|string|max:255',
        ];
    
    public function save()
    {
        $this->validate();

        Category::create(['nama' => $this->nama]);

        toastr()->success('Data Berhasil Ditambahkan!');

        $this->reset(['nama']);

        return redirect()->route('category.index');
    }

    public function render()
    {
        return view('livewire.admin.category.category-create');
    }
}
