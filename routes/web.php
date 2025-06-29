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
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/hewan', [AdminController::class, 'hewanIndex'])->name('admin.hewan.index');


});


// Dokter
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');
});

// Adopter
Route::middleware(['auth', 'role:adopter'])->group(function () {
    Route::get('/adopter/dashboard', [AdopterController::class, 'index'])->name('adopter.dashboard');
});

// Adopter - Lihat hewan tersedia
Route::middleware(['auth', 'role:adopter'])->group(function () {
    Route::get('/adopter/hewan', [AdopterController::class, 'hewanIndex'])->name('adopter.hewan.index');
    Route::get('/adopter/hewan/{id}', [AdopterController::class, 'show'])->name('adopter.hewan.show');
    Route::post('/adopter/adopsi/{id}', [AdopterController::class, 'ajukanAdopsi'])->name('adopter.adopsi');
    Route::get('/adopter/status-adopsi', [AdopterController::class, 'statusAdopsi'])->name('adopter.status');

});



// Pemberi Hibah
Route::middleware(['auth', 'role:pemberi'])->group(function () {
    // Dashboard
    Route::get('/pemberi/dashboard', [PemberiController::class, 'index'])->name('pemberi.dashboard');

    // CRUD Hewan
    Route::get('/pemberi/hewan', [PemberiController::class, 'hewanIndex'])->name('pemberi.hewan.index');
    Route::get('/pemberi/hewan/tambah', [PemberiController::class, 'create'])->name('pemberi.hewan.create');
    Route::post('/pemberi/hewan/tambah', [PemberiController::class, 'store'])->name('pemberi.hewan.store');
    Route::get('/pemberi/hewan/edit/{id}', [PemberiController::class, 'edit'])->name('pemberi.hewan.edit');
    Route::put('/pemberi/hewan/update/{id}', [PemberiController::class, 'update'])->name('pemberi.hewan.update');
    Route::delete('/pemberi/hewan/delete/{id}', [PemberiController::class, 'destroy'])->name('pemberi.hewan.destroy');
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
