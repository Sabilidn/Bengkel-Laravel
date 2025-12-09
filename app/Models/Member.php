<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $primaryKey = 'id'; // Primary key tabel
    public $incrementing = true; // Jika primary key menggunakan auto-increment
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable =[
        'nama',
        'nomor_handphone',
        'plat_nomor',
        'jenis_kendaraan'
    ];

     public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
