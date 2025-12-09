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
        Schema::create('members', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement(); // Primary key
            $table->string('nama',30)->unique();
            $table->string('nomor_handphone',15);
            $table->string('plat_nomor',15);
            $table->string('jenis_kendaraan',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
