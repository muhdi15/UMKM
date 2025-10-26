<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'seller_id',
        'category_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'berat',
        'foto',
        'status',
    ];

    // Relasi ke Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    // Relasi ke Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    // Relasi ke OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
