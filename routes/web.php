<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Pembeli;

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
    Route::get('/seller/{id}', [MasterController::class, 'sellerShow'])->name('admin.seller.show');
    // routes/web.php
    Route::put('/seller/{id}/status/{status}', [MasterController::class, 'sellerUpdateStatus'])->name('admin.seller.updateStatus');
    Route::delete('/seller/{id}', [MasterController::class, 'sellerDestroy'])->name('admin.seller.destroy');
});

// ===================================
// SELLER ROUTE
// ===================================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {});

// ===================================
// USER (PEMBELI) ROUTE
// ===================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard',[Pembeli::class,'userDashboard'])->name('user.dashboard');
    Route::get('/umkm',[Pembeli::class,'kategori'])->name('user.umkm');
    
});
