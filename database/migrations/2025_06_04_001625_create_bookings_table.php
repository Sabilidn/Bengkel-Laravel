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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
             $table->string('nama',50);
            $table->string('nomor_hp',15);
            $table->string('email',50);
            $table->string('tipe_kendaraan',30);
            $table->string('plat_nomor',30);
            $table->string('atas_nama',30);
            $table->dateTime('jadwal_service');
            $table->string('tipe_service',30);
            $table->string('status',30);
            $table->text('keluhan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
