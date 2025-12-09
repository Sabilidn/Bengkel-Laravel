<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

     protected $table = 'services';

    protected $primaryKey = 'id'; // Primary key tabel
    public $incrementing = true; // Jika primary key menggunakan auto-increment
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable = [
        'nama',
        'harga'
    ];

     public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
