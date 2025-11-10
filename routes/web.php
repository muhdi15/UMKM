<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Pembeli;

Route::get('/', [Pembeli::class, 'userDashboard'])->name('user.dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




// ===================================
// ADMIN ROUTE
// ===================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [MasterController::class, 'adminDashboard'])->name('admin.dashboard');

    //Seller
    Route::get('/seller', [MasterController::class, 'sellerIndex'])->name('admin.sellers');
    Route::get('/admin/seller/search', [MasterController::class, 'searchSeller'])->name('admin.seller.search');
    Route::get('/seller/map', [MasterController::class, 'sellerMap'])->name('admin.seller.map');
    Route::get('/seller/verifikasi', [MasterController::class, 'sellerVerifikasi'])->name('admin.seller.verifikasi');
    Route::get('/seller/{id}', [MasterController::class, 'sellerShow'])->name('admin.seller.show');
    Route::put('/seller/{id}/status/{status}', [MasterController::class, 'sellerUpdateStatus'])->name('admin.seller.updateStatus');
    Route::delete('/seller/{id}', [MasterController::class, 'sellerDestroy'])->name('admin.seller.destroy');


    //Profile Admin
    Route::get('/profile', [MasterController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [MasterController::class, 'profileUpdate'])->name('admin.profile.update');




    //produk
    Route::get('/produk', [MasterController::class, 'produkSeller'])->name('produk');
    Route::delete('/produk/{id}', [MasterController::class, 'destroyProdukSeller'])->name('produk.destroy');


    //kategory
    Route::get('/kategori', [MasterController::class, 'kategoriIndex'])->name('kategori.index');
    Route::post('/kategori/store', [MasterController::class, 'kategoriStore'])->name('kategori.store');
    Route::put('/kategori/update/{id}', [MasterController::class, 'kategoriUpdate'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}', [MasterController::class, 'kategoriDestroy'])->name('kategori.destroy');
});

// ===================================
// SELLER ROUTE
// ===================================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {});

// ===================================
// USER (PEMBELI) ROUTE
// ===================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/umkm', [Pembeli::class, 'kategori'])->name('user.umkm');
});
