<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    public $product_id;
    public $nama,$id_category,$harga,$stok,$gambar;

    protected $rules = [
        'nama'        => 'required|string|max:255',
        'id_category' => 'required|integer|exists:categories,id',
        'harga'       => 'required|numeric|min:0',
        'stok'        => 'required|integer|min:0',
        'gambar'      => 'required|image|max:2048', // max 2MB
    ];  

    public function mount($id)
    {
        $product = Product::find($id);
        $this->product_id = $product->id;
        $this->nama = $product->nama;
        $this->id_category = $product->id_category;
        $this->harga = $product->harga;
        $this->stok = $product->stok;
        $this->gambar = $product->gambar;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);

        // Simpan gambar baru jika diunggah
        if ($this->gambar) {
            $path = $this->gambar->store('gambar/produk', 'public');
        } else {
            $path = $this->old_gambar;
        }

        $product->update([
            'nama'        => $this->nama,
            'id_category' => $this->id_category,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'gambar'      => $path,
        ]);
        if(!$product){
            toastr()->error('Produk gagal diperbarui');
            return redirect()->back();
        }

        toastr()->success( 'Produk berhasil diperbarui.');
        return redirect()->route('product.index');
    }
    public function render()
    {
        return view('livewire.admin.product.product-edit',[
            'categorys'=>Category::all()
        ]);
    }
}
