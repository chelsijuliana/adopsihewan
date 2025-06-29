<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\PemberiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'dokter' => redirect('/dokter/dashboard'),
            'adopter' => redirect('/adopter/dashboard'),
            'pemberi' => redirect('/pemberi/dashboard'),
            default => view('welcome'),
        };
    }

    return view('welcome');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/hewan', [AdminController::class, 'hewanIndex'])->name('admin.hewan.index');
    Route::get('/admin/adopsi', [AdminController::class, 'adopsiIndex'])->name('admin.adopsi.index');
    Route::post('/admin/adopsi/{id}/setujui', [AdminController::class, 'setujuiAdopsi'])->name('admin.adopsi.setujui');
    Route::post('/admin/adopsi/{id}/tolak', [AdminController::class, 'tolakAdopsi'])->name('admin.adopsi.tolak');
    Route::get('/admin/medis', [AdminController::class, 'rekamMedisIndex'])->name('admin.medis.index');
    

});

Route::prefix('/admin/artikel')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'artikelIndex'])->name('admin.artikel.index');
    Route::get('/tambah', [AdminController::class, 'artikelCreate'])->name('admin.artikel.create');
    Route::post('/tambah', [AdminController::class, 'artikelStore'])->name('admin.artikel.store');
    Route::get('/edit/{id}', [AdminController::class, 'artikelEdit'])->name('admin.artikel.edit');
    Route::put('/update/{id}', [AdminController::class, 'artikelUpdate'])->name('admin.artikel.update');
    Route::delete('/hapus/{id}', [AdminController::class, 'artikelDestroy'])->name('admin.artikel.destroy');
});


// =====================
// 🧑‍⚕️ ROUTE DOKTER
// =====================
Route::middleware(['auth', 'role:dokter'])->group(function () {
    // Dashboard
    Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.dashboard');

    // Lihat daftar hewan dan detailnya
    Route::get('/dokter/hewan', [DokterController::class, 'hewanIndex'])->name('dokter.hewan.index');
    Route::get('/dokter/hewan/{id}', [DokterController::class, 'hewanDetail'])->name('dokter.hewan.detail');

    // Tambah rekam medis (GET dan POST)
    Route::get('/dokter/hewan/{id}/rekam-medis/tambah', function ($id) {
        $hewan = App\Models\ChelsiAnimal::findOrFail($id);
        return view('dokter.rekam.tambah', compact('hewan'));
    })->name('dokter.rekam-medis.tambah');
    
    Route::post('/dokter/hewan/{id}/rekam-medis/tambah', [DokterController::class, 'tambahRekamMedis'])->name('dokter.rekam-medis.store');

    // Edit rekam medis
    Route::get('/dokter/rekam-medis/{id}/edit', [DokterController::class, 'editRekamMedis'])->name('dokter.rekam-medis.edit');
    Route::put('/dokter/rekam-medis/{id}', [DokterController::class, 'updateRekamMedis'])->name('dokter.rekam-medis.update');
});


// Adopter
Route::middleware(['auth', 'role:adopter'])->group(function () {
    
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

Route::get('/', [HomeController::class, 'index'])->name('home');