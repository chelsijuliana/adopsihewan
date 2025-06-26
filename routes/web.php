<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\PemberiController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
});

// Adopter
Route::middleware(['auth', 'role:adopter'])->group(function () {
    Route::get('/adopter/dashboard', [AdopterController::class, 'index'])->name('adopter.dashboard');
});

// Pemberi Hibah
Route::middleware(['auth', 'role:pemberi'])->group(function () {
    Route::get('/pemberi/dashboard', [PemberiController::class, 'index'])->name('pemberi.dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
