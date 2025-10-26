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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        /**
         * 3️⃣ Sellers Table
         */
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_toko', 150);
            $table->text('deskripsi')->nullable();
            $table->text('alamat');
            $table->string('no_telp', 20);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('foto_toko')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /**
         * 4️⃣ Categories Table
         */
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        /**
         * 5️⃣ Products Table
         */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('nama_produk', 150);
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->integer('stok')->default(0);
            $table->decimal('berat', 8, 2)->default(0);
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });

        /**
         * 6️⃣ Carts Table
         */
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });

        /**
         * 7️⃣ Orders Table
         */
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->string('kode_order', 50)->unique();
            $table->decimal('total_harga', 12, 2);
            $table->decimal('ongkir', 12, 2)->default(0);
            $table->enum('metode_pembayaran', ['cod', 'transfer', 'qris'])->default('cod');
            $table->enum('status_pembayaran', ['pending', 'dibayar', 'gagal'])->default('pending');
            $table->enum('status_order', ['diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('diproses');
            $table->text('alamat_pengiriman');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        /**
         * 8️⃣ Order Details Table
         */
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->decimal('harga_satuan', 12, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });

        /**
         * 9️⃣ Reviews Table
         */
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating')->default(5);
            $table->text('komentar')->nullable();
            $table->timestamps();
        });

        /**
         * 🔟 Payments Table
         */
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('metode', ['cod', 'transfer', 'qris'])->default('cod');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', ['pending', 'valid', 'invalid'])->default('pending');
            $table->timestamps();
        });

        /**
         * 11️⃣ User Addresses Table
         */
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_penerima', 100);
            $table->string('no_telp', 20);
            $table->text('alamat');
            $table->string('provinsi', 100);
            $table->string('kota', 100);
            $table->string('kecamatan', 100);
            $table->string('kode_pos', 10);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
