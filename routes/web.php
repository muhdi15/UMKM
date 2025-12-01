<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Pembeli;
use Illuminate\Support\Facades\Auth;
use App\Http\Controller\SellerController;
use App\Models\Review;


Route::get('/', function () {
    // Jika belum login, arahkan langsung ke halaman pembeli.home
    if (!Auth::check()) {
        return view('pembeli.home');
    }

    // Jika sudah login tapi rolenya admin atau seller, tolak akses
    if (in_array(Auth::user()->role->name, ['admin', 'seller'])) {
        // abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        return redirect()->back();
    }

    // Jika role user, tampilkan dashboard pembeli
    return app(\App\Http\Controllers\Pembeli::class)->userDashboard();
})->name('user.dashboard');

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


    //konsumen
    Route::get('/konsumen', [MasterController::class, 'konsumen'])->name('admin.konsumen');
    Route::post('/konsumen/{id}/approve', [MasterController::class, 'approveKonsumen'])->name('admin.konsumen.approve');
    Route::delete('/konsumen/{id}', [MasterController::class, 'destroyKonsumen'])->name('admin.konsumen.destroy');

    //laporan
    Route::get('/laporan', [MasterController::class, 'laporanindex'])->name('admin.laporan');
    Route::get('/products', [MasterController::class, 'productsReport'])->name('admin.laporan.products');
    Route::get('/customers', [MasterController::class, 'customersReport'])->name('admin.laporan.customers');
    Route::post('/export', [MasterController::class, 'export'])->name('admin.laporan.export');
    Route::get('/sales-chart', [MasterController::class, 'salesChartData'])->name('admin.laporan.sales-chart');
    Route::get('/dashboard-stats', [MasterController::class, 'dashboardStats'])->name('admin.laporan.dashboard-stats');

    
});

// ===================================
// SELLER ROUTE
// ===================================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {

     Route::get('/dashboard', [App\Http\Controllers\SellerController::class, 'dashboard'])->name('seller.dashboard');

      // Profile Toko
    Route::get('/profile', [App\Http\Controllers\SellerController::class, 'profile'])
        ->name('seller.profile');

    Route::post('/profile/update', [App\Http\Controllers\SellerController::class, 'updateProfile'])
        ->name('seller.profile.update');


    // Produk
    Route::get('/products', [App\Http\Controllers\SellerController::class, 'products'])->name('seller.products');
    Route::get('/products/create', [App\Http\Controllers\SellerController::class, 'createProduct'])->name('seller.products.create');
    Route::post('/products/store', [App\Http\Controllers\SellerController::class, 'storeProduct'])->name('seller.products.store');
    Route::get('/products/{id}/edit', [App\Http\Controllers\SellerController::class, 'editProduct'])->name('seller.products.edit');
    Route::post('/products/{id}/update', [App\Http\Controllers\SellerController::class, 'updateProduct'])->name('seller.products.update');
    Route::delete('/products/{id}/delete', [App\Http\Controllers\SellerController::class, 'deleteProduct'])->name('seller.products.delete');


    //Order
    Route::get('/orders', [App\Http\Controllers\SellerController::class, 'orders'])->name('seller.orders');
    Route::get('/orders/{id}', [App\Http\Controllers\SellerController::class, 'orderDetail'])->name('orders.detail');
    Route::post('/orders/{id}/status', [App\Http\Controllers\SellerController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    //review
    Route::get('/reviews', [SellerController::class, 'reviews'])->name('reviews');  



    

});

// ===================================
// USER (PEMBELI) ROUTE
// ===================================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/umkm', [Pembeli::class, 'kategori'])->name('user.umkm');
    Route::get('/home',[Pembeli::class,'userDashboard'])->name('user.dashboard');
    Route::get('/umkm',[Pembeli::class,'kategori'])->name('user.umkm');
    Route::get('/about',[Pembeli::class,'about'])->name('user.about');
    Route::get('/contact',[Pembeli::class,'contact'])->name('user.contact');
    Route::get('/keranjang',[Pembeli::class,'keranjang'])->name('user.keranjang');
    Route::get('/history',[Pembeli::class,'history'])->name('user.history');
    Route::get('/wishlist',[Pembeli::class,'wishlist'])->name('user.wishlist');
    Route::get('/profil',[Pembeli::class,'profil'])->name('user.profil');
    

});  