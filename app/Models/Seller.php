<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'sellers';

    protected $fillable = [
        'user_id',
        'nama_toko',
        'deskripsi',
        'alamat',
        'no_telp',
        'latitude',
        'longitude',
        'foto_toko',
        'status',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Product
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
}
