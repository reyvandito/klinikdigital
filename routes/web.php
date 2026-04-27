<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterDashboardController;
use App\Http\Controllers\DashboardPasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== HOME & PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');

// ==================== AUTH ROUTES ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== DASHBOARD ROUTES ====================
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/dokter', [DokterDashboardController::class, 'index'])->name('dokter');
    Route::get('/pasien', [DashboardPasienController::class, 'index'])->name('pasien');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Manajemen Dokter
    Route::prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/', [AdminController::class, 'dokterIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'dokterCreate'])->name('create');
        Route::get('/edit/{id}', [AdminController::class, 'dokterEdit'])->name('edit');
        Route::post('/store', [AdminController::class, 'dokterStore'])->name('store');
        Route::put('/update/{id}', [AdminController::class, 'dokterUpdate'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'dokterDelete'])->name('delete');
        Route::get('/verify/{id}', [AdminController::class, 'dokterVerify'])->name('verify');
        Route::get('/reject/{id}', [AdminController::class, 'dokterReject'])->name('reject');
    });
    
    // Manajemen Pasien
    Route::prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/', [AdminController::class, 'pasienIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'pasienCreate'])->name('create');
        Route::get('/edit/{id}', [AdminController::class, 'pasienEdit'])->name('edit');
        Route::post('/store', [AdminController::class, 'pasienStore'])->name('store');
        Route::put('/update/{id}', [AdminController::class, 'pasienUpdate'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'pasienDelete'])->name('delete');
    });
    
    // Manajemen Jadwal
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [AdminController::class, 'jadwalIndex'])->name('index');
        Route::get('/update-status/{id}', [AdminController::class, 'jadwalUpdateStatus'])->name('update-status');
    });
    
    // Manajemen Reservasi
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [AdminController::class, 'reservasiIndex'])->name('index');
        Route::get('/detail/{id}', [AdminController::class, 'reservasiDetail'])->name('detail');
        Route::put('/update-status/{id}', [AdminController::class, 'reservasiUpdateStatus'])->name('update-status');
        Route::delete('/delete/{id}', [AdminController::class, 'reservasiDelete'])->name('delete');
    });
    
    // Profile & Settings
    Route::get('/profile', [AdminController::class, 'profileIndex'])->name('profile');
    Route::put('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/settings', [AdminController::class, 'settingsIndex'])->name('settings');
    Route::post('/settings/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');
});

// ==================== DOKTER ROUTES ====================
Route::prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [DokterDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [DokterDashboardController::class, 'updateProfile'])->name('profile.update');
    
    // Status & Jadwal
    Route::post('/update-status', [DokterDashboardController::class, 'updateStatus'])->name('update.status');
    Route::post('/update-jadwal', [DokterDashboardController::class, 'updateJadwal'])->name('update.jadwal');
    
    // Konsultasi
    Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
        Route::get('/mulai/{id}', [DokterDashboardController::class, 'mulaiKonsultasi'])->name('mulai');
        Route::get('/selesai/{id}', [DokterDashboardController::class, 'selesaiKonsultasi'])->name('selesai');
        Route::get('/riwayat', [DokterDashboardController::class, 'riwayatKonsultasi'])->name('riwayat');
        Route::get('/detail/{id}', [DokterDashboardController::class, 'detailKonsultasi'])->name('detail');
    });
    
    // Pasien
    Route::prefix('pasien')->name('pasien.')->group(function () {
        Route::get('/', [DokterDashboardController::class, 'daftarPasien'])->name('index');
        Route::get('/detail/{id}', [DokterDashboardController::class, 'detailPasien'])->name('detail');
        Route::post('/catatan/{id}', [DokterDashboardController::class, 'simpanCatatan'])->name('catatan');
    });
});

// ==================== PASIEN ROUTES ====================
Route::prefix('pasien')->name('pasien.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardPasienController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [DashboardPasienController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [DashboardPasienController::class, 'updateProfile'])->name('profile.update');
    
    // Reservasi
    Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/success', [ReservasiController::class, 'success'])->name('reservasi.success');
    Route::get('/reservasi/batal/{id}', [ReservasiController::class, 'batal'])->name('reservasi.batal');
    
    // Riwayat Reservasi
    Route::get('/riwayat', [ReservasiController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/detail/{id}', [ReservasiController::class, 'detailRiwayat'])->name('riwayat.detail');
    
    // Rekam Medis
    Route::get('/rekam-medis', [DashboardPasienController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DashboardPasienController::class, 'detailRekamMedis'])->name('rekam-medis.detail');
});

// ==================== FALLBACK ROUTE ====================
// Route::fallback(function () {
//     return view('errors.404');
// });