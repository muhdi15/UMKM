<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




// ===================================
// ADMIN ROUTE
// ===================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [MasterController::class, 'adminDashboard'])->name('admin.dashboard');

    Route::get('/seller', [MasterController::class, 'sellerIndex'])->name('admin.sellers');
    Route::get('/seller/verifikasi', [MasterController::class, 'sellerVerifikasi'])->name('admin.seller.verifikasi');
    Route::get('/seller/{id}', [MasterController::class, 'sellerShow'])->name('admin.seller.show');
    Route::put('/seller/{id}/status/{status}', [MasterController::class, 'sellerUpdateStatus'])->name('admin.seller.updateStatus');
    Route::delete('/seller/{id}', [MasterController::class, 'sellerDestroy'])->name('admin.seller.destroy');

    Route::get('/produk', [MasterController::class, 'produkSeller'])->name('produk');
    Route::delete('/produk/{id}', [MasterController::class, 'destroyProdukSeller'])->name('produk.destroy');

    

});

// ===================================
// SELLER ROUTE
// ===================================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {});

// ===================================
// USER (PEMBELI) ROUTE
// ===================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard',[MasterController::class,'userDashboard'])->name('user.dashboard');
});
