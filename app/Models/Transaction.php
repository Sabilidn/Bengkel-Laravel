<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    protected $primaryKey = 'id'; // Primary key tabel
    public $incrementing = true; // Jika primary key menggunakan auto-increment
    protected $keyType = 'int'; // Tipe data primary key
    protected $fillable = [
        'user_id',
        'member_id',
        'plat_nomor',
        'jenis_kendaraan',
        'jenis_transaksi',
        'product_id',
        'service_id',
        'invoice',
        'qty',
        'total',
        'bayar',
        'kembalian',
        'metode_bayar',
        'nama_bank',
        'nomor_rekening',
        'nominal_debit'
    ];

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get all of the transaction_details for the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
