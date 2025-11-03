<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\{
    Role, User, Seller, Category, Product, Cart,
    Order, OrderDetail, Review, Payment, UserAddress
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        /**
         * 1️⃣ Roles
         */
        Role::insert([
            ['name' => 'admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'seller', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'user', 'created_at' => $now, 'updated_at' => $now],
        ]);

        /**
         * 2️⃣ Users
         */
        User::insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@example.com',
                'role_id' => 1,
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Toko Maju Seller',
                'email' => 'seller@example.com',
                'role_id' => 2,
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Budi Pembeli',
                'email' => 'budi@example.com',
                'role_id' => 3,
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 3️⃣ Sellers
         */
        Seller::insert([
            [
                'user_id' => 2,
                'nama_toko' => 'Toko Elektronik Maju',
                'deskripsi' => 'Menjual berbagai barang elektronik rumah tangga.',
                'alamat' => 'Jl. Trans Sulawesi No.45, Majene',
                'no_telp' => '081234567890',
                'latitude' => -3.4321000,
                'longitude' => 119.3332100,
                'foto_toko' => 'toko_elektronik.jpg',
                'status' => 'aktif',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'nama_toko' => 'Toko Fashion Modern',
                'deskripsi' => 'Menjual pakaian pria dan wanita kekinian.',
                'alamat' => 'Jl. Poros Polewali No.21',
                'no_telp' => '082233445566',
                'latitude' => -3.4310000,
                'longitude' => 119.3340000,
                'foto_toko' => 'toko_fashion.jpg',
                'status' => 'aktif',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 4️⃣ Categories
         */
        Category::insert([
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Produk-produk elektronik seperti TV, Kipas, dan kulkas.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_kategori' => 'Fashion',
                'deskripsi' => 'Pakaian dan aksesoris fashion pria dan wanita.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 5️⃣ Products
         */
        Product::insert([
            [
                'seller_id' => 1,
                'category_id' => 1,
                'nama_produk' => 'Kipas Angin Cosmos 16 Inch',
                'deskripsi' => 'Kipas angin dengan 3 kecepatan, hemat listrik.',
                'harga' => 250000.00,
                'stok' => 15,
                'berat' => 3.50,
                'foto' => 'kipas_cosmos.jpg',
                'status' => 'aktif',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'seller_id' => 2,
                'category_id' => 2,
                'nama_produk' => 'Kemeja Pria Lengan Panjang',
                'deskripsi' => 'Kemeja bahan katun, nyaman dipakai.',
                'harga' => 175000.00,
                'stok' => 30,
                'berat' => 0.40,
                'foto' => 'kemeja_pria.jpg',
                'status' => 'aktif',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 6️⃣ Carts
         */
        Cart::insert([
            [
                'user_id' => 3,
                'product_id' => 1,
                'quantity' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'product_id' => 2,
                'quantity' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 7️⃣ Orders
         */
        Order::insert([
            [
                'user_id' => 3,
                'seller_id' => 1,
                'kode_order' => 'ORD-' . Str::upper(Str::random(8)),
                'total_harga' => 250000.00,
                'ongkir' => 15000.00,
                'metode_pembayaran' => 'transfer',
                'status_pembayaran' => 'dibayar',
                'status_order' => 'dikirim',
                'alamat_pengiriman' => 'Jl. Trans Sulawesi No.88, Majene',
                'catatan' => 'Mohon dikirim siang hari.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'seller_id' => 2,
                'kode_order' => 'ORD-' . Str::upper(Str::random(8)),
                'total_harga' => 350000.00,
                'ongkir' => 20000.00,
                'metode_pembayaran' => 'cod',
                'status_pembayaran' => 'pending',
                'status_order' => 'diproses',
                'alamat_pengiriman' => 'Jl. Poros Majene No.45',
                'catatan' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 8️⃣ Order Details
         */
        OrderDetail::insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'harga_satuan' => 250000.00,
                'quantity' => 1,
                'subtotal' => 250000.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'order_id' => 2,
                'product_id' => 2,
                'harga_satuan' => 175000.00,
                'quantity' => 2,
                'subtotal' => 350000.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 9️⃣ Reviews
         */
        Review::insert([
            [
                'product_id' => 1,
                'user_id' => 3,
                'rating' => 5,
                'komentar' => 'Produk sesuai deskripsi dan berfungsi dengan baik.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => 2,
                'user_id' => 3,
                'rating' => 4,
                'komentar' => 'Bahan bagus, pengiriman cepat.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 🔟 Payments
         */
        Payment::insert([
            [
                'order_id' => 1,
                'metode' => 'transfer',
                'bukti_bayar' => 'bukti_transfer_1.jpg',
                'status' => 'valid',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'order_id' => 2,
                'metode' => 'cod',
                'bukti_bayar' => null,
                'status' => 'pending',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /**
         * 11️⃣ User Addresses
         */
        UserAddress::insert([
            [
                'user_id' => 3,
                'nama_penerima' => 'Budi Pembeli',
                'no_telp' => '081233344455',
                'alamat' => 'Jl. Trans Sulawesi No.88',
                'provinsi' => 'Sulawesi Barat',
                'kota' => 'Majene',
                'kecamatan' => 'Banggae',
                'kode_pos' => '91412',
                'is_default' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'nama_penerima' => 'Budi Pembeli',
                'no_telp' => '081233344456',
                'alamat' => 'Jl. Poros Polewali No.22',
                'provinsi' => 'Sulawesi Barat',
                'kota' => 'Polewali Mandar',
                'kecamatan' => 'Polewali',
                'kode_pos' => '91413',
                'is_default' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
