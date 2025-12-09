<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = "transaction_details";
    protected $primaryKey = 'id'; // Primary key tabel
    public $incrementing = true; // Jika primary key menggunakan auto-increment
    protected $keyType = 'int'; // Tipe data primary key
    protected $fillable = [
        'transaction_id',
        'nama_item',
        'jenis',
        'qty',
        'harga',
        'total'
    ];

    /**
     * Get the transaction that owns the TransactionDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }
}
