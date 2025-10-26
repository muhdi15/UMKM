<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'seller_id',
        'kode_order',
        'total_harga',
        'ongkir',
        'metode_pembayaran',
        'status_pembayaran',
        'status_order',
        'alamat_pengiriman',
        'catatan',
    ];

    // Relasi ke User (pembeli)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Seller (penjual)
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    // Relasi ke Order Detail
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // Relasi ke Payment
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}
