<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;


Route::middleware(['isAdmin'])->group(function () {
    

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/residents-chart-data', [DashboardController::class, 'getResidentsChartData']);
Route::get('/dashboard/rooms-chart-data', [DashboardController::class, 'getRoomsChartData']);

// ------------ Rooms -------------
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
Route::get('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/update/{id}', [RoomController::class, 'update'])->name('rooms.update');

// ------------ End Rooms -------------

// ------------ Categories -------------
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
// ---------------- End Categories -------------

// ------------ Stock -------------
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
// Route::get('/stock', [StockController::class, 'statistics'])->name('stock.statistics');
Route::get('/stock/create', [StockController::class, 'create'])->name('stock.create');
Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
Route::get('/stock/edit/{id}', [StockController::class, 'edit'])->name('stock.edit');
Route::put('/stock/update/{id}', [StockController::class, 'update'])->name('stock.update');
Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.destroy');

// ------------ End Stock -------------

// ------------ Supplier -------------
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::get('/supplier/edite/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('/supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
// ------------ End Supplier -------------


    Route::get('/residents', [ResidentController::class, 'index'])->name('residents.index');
    Route::post('/residents', [ResidentController::class, 'store'])->name('residents.store');
    Route::get('/residents/create', [ResidentController::class, 'create'])->name('residents.create');
    Route::get('/residents/{id}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
    Route::put('/residents/{id}', [ResidentController::class, 'update'])->name('residents.update');
    Route::delete('/residents/{id}', [ResidentController::class, 'destroy'])->name('residents.destroy');
    Route::get('/residents/{id}/download', [ResidentController::class, 'downloadPdf'])->name('residents.download');






});

// ------------ Password Managements -------------
Route::get('/resetPassword', [ForgotPasswordController::class, 'Index'])->name('forgot.password');
Route::post('/forget_password_post', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forget.password.post');
Route::get('/reset_password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset_password_post', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// ------------ End Password Managements -------------

// ------------ Auth -------------
Route::get('/', [AuthController::class, 'showLoginForm']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
// ------------ End Auth -------------

// ------------ Logout -------------
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// ------------ End Logout -------------


// ------------ Profile -------------
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
// Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
// Route::get('/profile/change-password', [AuthController::class, 'showChangePasswordForm'])->name('profile.change-password');
