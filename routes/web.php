<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AutController;


Route::get('/', function () {
    return view('Auth.login');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms');
Route::put('/rooms', [RoomController::class, 'edit'])->name('rooms');


Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::post('/stock', [StockController::class, 'store'])->name('stock');
Route::put('/stock', [StockController::class, 'edit'])->name('stock');

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier');
Route::put('/supplier', [SupplierController::class, 'edit'])->name('supplier');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/residents', [ResidentController::class, 'index'])->name('residents');


Route::get('/login', [AutController::class,'login'])->name('login');
Route::get('/resetPassword', [AutController::class,'resetPassword'])->name('resetPassword');


