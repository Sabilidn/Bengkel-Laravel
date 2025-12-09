<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookings";
    protected $fillable = [
        'nama',
        'nomor_hp',
        'email',
        'tipe_kendaraan',
        'plat_nomor',
        'atas_nama',
        'jadwal_service',
        'tipe_service',
        'keluhan',
        'status'
    ];

     protected $casts = [
        'jadwal_service' => 'datetime',
    ];
}
