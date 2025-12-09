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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // Primary key
            $table->unsignedInteger('transaction_id')->nullable(); // Foreign key ke categories
             $table->foreign('transaction_id')
                ->references('id') // Relasi ke id_category di tabel categories
                ->on('transactions')
                ->cascadeOnDelete(); 
                $table->string('nama_item',50);
                $table->string('jenis',30);
                $table->string('qty',5);
                $table->string('harga',30);
                $table->string('total',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
