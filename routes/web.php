<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/loginPost',[AuthController::class,'loginPost'])->name('login.post');

Route::get('/profile',[AuthController::class,'profile'])->name('profile');