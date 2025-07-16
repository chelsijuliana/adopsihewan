<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\PemberiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PublicController;


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
    Route::get('/admin/artikel', [AdminController::class, 'artikelIndex'])->name('admin.artikel.index');
    Route::get('/admin/artikel/tambah', [AdminController::class, 'artikelCreate'])->name('admin.artikel.create');
    Route::post('/admin/artikel', [AdminController::class, 'artikelStore'])->name('admin.artikel.store');
    Route::get('/admin/artikel/edit/{id}', [AdminController::class, 'artikelEdit'])->name('admin.artikel.edit');
    Route::put('/admin/artikel/update/{id}', [AdminController::class, 'artikelUpdate'])->name('admin.artikel.update');
    Route::delete('/admin/artikel/delete/{id}', [AdminController::class, 'hapusArtikel'])->name('admin.artikel.delete');
    Route::get('/admin/pengguna', [AdminController::class, 'penggunaIndex'])->name('admin.pengguna.index');
    Route::get('/admin/hewan', [AdminController::class, 'hewanIndex'])->name('admin.hewan.index');
    //kelola pengguna
    Route::get('/admin/pengguna/edit/{id}', [AdminController::class, 'editUser'])->name('admin.pengguna.edit');
    Route::delete('/admin/pengguna/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.pengguna.delete');
    Route::put('/admin/pengguna/update/{id}', [AdminController::class, 'updateUser'])->name('admin.pengguna.update');

});

/*Route::prefix('/admin/artikel')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'artikelIndex'])->name('admin.artikel.index');
    Route::get('/tambah', [AdminController::class, 'artikelCreate'])->name('admin.artikel.create');
    Route::post('/tambah', [AdminController::class, 'artikelStore'])->name('admin.artikel.store');
    Route::get('/edit/{id}', [AdminController::class, 'artikelEdit'])->name('admin.artikel.edit');
    Route::put('/update/{id}', [AdminController::class, 'artikelUpdate'])->name('admin.artikel.update');
    Route::delete('/hapus/{id}', [AdminController::class, 'artikelDestroy'])->name('admin.artikel.destroy');
});*/


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

    // Ubah status hewan
    Route::put('/dokter/hewan/{id}/ubah-status', [DokterController::class, 'ubahStatus'])->name('dokter.hewan.ubah-status');

    // Rekap Pemeriksaan
    Route::get('/dokter/pemeriksaan', [DokterController::class, 'rekapIndex'])->name('dokter.rekam.index');
    Route::get('/dokter/pemeriksaan/{id}', [DokterController::class, 'rekapDetail'])->name('dokter.rekam.detail');


});



// Adopter
Route::middleware(['auth', 'role:adopter'])->group(function () {
    
});

// Adopter - Lihat hewan tersedia
Route::middleware(['auth', 'role:adopter'])->group(function () {
    Route::get('/adopter/dashboard', [AdopterController::class, 'index'])->name('adopter.dashboard');
    Route::get('/adopter/hewan', [AdopterController::class, 'hewanIndex'])->name('adopter.hewan.index');
    Route::get('/adopter/hewan/{id}', [AdopterController::class, 'show'])->name('adopter.hewan.show');
    Route::post('/adopter/adopsi/{id}', [AdopterController::class, 'ajukanAdopsi'])->name('adopter.adopsi');
    Route::get('/adopter/status-adopsi', [AdopterController::class, 'statusAdopsi'])->name('adopter.status');
    Route::get('/adopter/hewan/{id}/rekam-medis', [AdopterController::class, 'rekamMedis'])->name('adopter.rekam-medis.lihat');
    Route::get('/adopter/hewan/{id}', [AdopterController::class, 'show'])->name('adopter.hewan.show');
    Route::get('/adopter/adopsi/{id}/form', [AdopterController::class, 'formAjukanAdopsi'])->name('adopter.adopsi.form');
    Route::delete('/adopter/adopsi/batalkan/{id}', [AdopterController::class, 'batalkanAdopsi'])->name('adopter.adopsi.batalkan');

    




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

    Route::get('/pemberi/hewan/detail/{id}', [PemberiController::class, 'detailHewan'])->name('pemberi.hewan.detail');

    Route::get('/pemberi/pengajuan-adopsi', [PemberiController::class, 'pengajuanAdopsiIndex'])->name('pemberi.adopsi.index');
    Route::post('/pemberi/pengajuan-adopsi/{id}/setujui', [PemberiController::class, 'setujuiAdopsi'])->name('pemberi.adopsi.setujui');
    Route::post('/pemberi/pengajuan-adopsi/{id}/tolak', [PemberiController::class, 'tolakAdopsi'])->name('pemberi.adopsi.tolak');

    


});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');

//Route::get('/galeri-adopsi', [GaleriController::class, 'index'])->name('galeri.adopsi');
Route::get('/galeri-adopsi', [GaleriController::class, 'index']);


// Halaman Publik - Artikel
Route::get('/artikel', [PublicController::class, 'listArtikel'])->name('artikel.index');
Route::get('/artikel/{id}', [PublicController::class, 'detailArtikel'])->name('artikel.show');

