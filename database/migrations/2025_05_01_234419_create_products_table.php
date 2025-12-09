<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // Primary key
            $table->string('nama',50);
            $table->unsignedInteger('id_category')->nullable(); // Foreign key ke categories
            $table->foreign('id_category')
                ->references('id') // Relasi ke id_category di tabel categories
                ->on('categories')
                ->cascadeOnDelete(); // Hapus produk jika kategori dihapus  
            $table->decimal('harga', 12, 2); // Harga Produk
            $table->integer('stok'); // Stok Produk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
