<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterDashboardController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\FeedbackController;

// ==================== HOME & PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dokter', [DokterController::class, 'index'])->name('dokter');

// ==================== AUTH ROUTES ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('role:admin');
    
    // Manajemen Dokter
    Route::prefix('dokter')->name('dokter.')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'dokterIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'dokterCreate'])->name('create');
        Route::post('/store', [AdminController::class, 'dokterStore'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'dokterEdit'])->name('edit');
        Route::put('/update/{id}', [AdminController::class, 'dokterUpdate'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'dokterDelete'])->name('delete');
        Route::get('/verify/{id}', [AdminController::class, 'dokterVerify'])->name('verify');
        Route::get('/reject/{id}', [AdminController::class, 'dokterReject'])->name('reject');
    });
    
    // Manajemen Pasien
    Route::prefix('pasien')->name('pasien.')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'pasienIndex'])->name('index');
        Route::get('/create', [AdminController::class, 'pasienCreate'])->name('create');
        Route::post('/store', [AdminController::class, 'pasienStore'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'pasienEdit'])->name('edit');
        Route::put('/update/{id}', [AdminController::class, 'pasienUpdate'])->name('update');
        Route::delete('/delete/{id}', [AdminController::class, 'pasienDelete'])->name('delete');
    });
    
    // Manajemen Jadwal
    Route::prefix('jadwal')->name('jadwal.')->middleware('role:admin')->group(function () {
        Route::get('/', [AdminController::class, 'jadwalIndex'])->name('index');
        Route::get('/update-status/{id}', [AdminController::class, 'jadwalUpdateStatus'])->name('update-status');
    });
    
    // Manajemen Reservasi
    Route::prefix('reservasi')->name('reservasi.')->middleware('role:admin')->group(function () {
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

    // ==================== FEEDBACK ADMIN ====================
    Route::prefix('feedback')->name('feedback.')->middleware('role:admin')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::get('/{id}', [FeedbackController::class, 'show'])->name('show');
        Route::post('/update-status/{id}', [FeedbackController::class, 'updateStatus'])->name('update-status');
        Route::post('/response/{id}', [FeedbackController::class, 'sendResponse'])->name('response');
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('destroy');
    });
});

// ==================== DOKTER ROUTES ====================
Route::middleware(['auth'])->prefix('dokter')->name('dokter.')->group(function () {
    
    Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard')->middleware('role:dokter');
    Route::get('/profile', [DokterDashboardController::class, 'profile'])->name('profile')->middleware('role:dokter');
    Route::put('/profile/update', [DokterDashboardController::class, 'updateProfile'])->name('profile.update')->middleware('role:dokter');
    Route::post('/update-status', [DokterDashboardController::class, 'updateStatus'])->name('update.status')->middleware('role:dokter');
    
    // Manage Jadwal
    Route::get('/jadwal', [DokterDashboardController::class, 'jadwalIndex'])->name('jadwal.index')->middleware('role:dokter');
    Route::post('/jadwal', [DokterDashboardController::class, 'jadwalStore'])->name('jadwal.store')->middleware('role:dokter');
    Route::delete('/jadwal/{id}', [DokterDashboardController::class, 'jadwalDestroy'])->name('jadwal.destroy')->middleware('role:dokter');
    
    // Konsultasi
    Route::prefix('konsultasi')->name('konsultasi.')->middleware('role:dokter')->group(function () {
        Route::post('/mulai/{id}', [DokterDashboardController::class, 'mulaiKonsultasi'])->name('mulai');
        Route::post('/selesai/{id}', [DokterDashboardController::class, 'selesaiKonsultasi'])->name('selesai');
        Route::get('/riwayat', [DokterDashboardController::class, 'riwayatKonsultasi'])->name('riwayat');
        Route::get('/detail/{id}', [DokterDashboardController::class, 'detailKonsultasi'])->name('detail');
    });
    
    // Pasien
    Route::prefix('pasien')->name('pasien.')->middleware('role:dokter')->group(function () {
        Route::get('/', [DokterDashboardController::class, 'daftarPasien'])->name('index');
        Route::get('/detail/{id}', [DokterDashboardController::class, 'detailPasien'])->name('detail');
        Route::post('/catatan/{id}', [DokterDashboardController::class, 'simpanCatatan'])->name('catatan');
    });
    
    // Rekam Medis
    Route::prefix('rekam-medis')->name('rekam-medis.')->middleware('role:dokter')->group(function () {
        Route::get('/', [DokterDashboardController::class, 'rekamMedisIndex'])->name('index');
        Route::get('/create', [DokterDashboardController::class, 'rekamMedisCreate'])->name('create');
        Route::post('/store', [DokterDashboardController::class, 'rekamMedisStore'])->name('store');
        Route::get('/edit', [DokterDashboardController::class, 'rekamMedisEdit'])->name('edit');
        Route::put('/update/{id}', [DokterDashboardController::class, 'rekamMedisUpdate'])->name('update');
        Route::delete('/delete/{id}', [DokterDashboardController::class, 'rekamMedisDelete'])->name('delete');
        Route::get('/show/{id}', [DokterDashboardController::class, 'rekamMedisShow'])->name('show');
    });

    // ==================== FEEDBACK DOKTER ====================
    Route::prefix('feedback')->name('feedback.')->middleware('role:dokter')->group(function () {
        Route::get('/', [FeedbackController::class, 'indexDokter'])->name('index');
        Route::get('/{id}', [FeedbackController::class, 'showDokter'])->name('show');
        Route::post('/update-status/{id}', [FeedbackController::class, 'updateStatusDokter'])->name('update-status');
    });
});

// ==================== PASIEN ROUTES ====================
Route::middleware(['auth'])->prefix('pasien')->name('pasien.')->group(function () {
    
    Route::get('/dashboard', [DashboardPasienController::class, 'index'])->name('dashboard')->middleware('role:pasien');
    Route::get('/profile', [DashboardPasienController::class, 'profile'])->name('profile')->middleware('role:pasien');
    Route::put('/profile/update', [DashboardPasienController::class, 'updateProfile'])->name('profile.update')->middleware('role:pasien');
    Route::get('/rekam-medis', [DashboardPasienController::class, 'rekamMedis'])->name('rekam-medis')->middleware('role:pasien');
    Route::get('/rekam-medis/{id}', [DashboardPasienController::class, 'detailRekamMedis'])->name('rekam-medis.detail')->middleware('role:pasien');
    
    // Reservasi
    Route::get('/reservasi', [ReservasiController::class, 'create'])->name('reservasi.create')->middleware('role:pasien');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store')->middleware('role:pasien');
    Route::get('/reservasi/success', [ReservasiController::class, 'success'])->name('reservasi.success')->middleware('role:pasien');
    Route::get('/reservasi/batal/{id}', [ReservasiController::class, 'batal'])->name('reservasi.batal')->middleware('role:pasien');
    Route::get('/reservasi/jadwal', [ReservasiController::class, 'getJadwalByDokter'])->name('reservasi.jadwal')->middleware('role:pasien');
    Route::get('/riwayat', [ReservasiController::class, 'riwayat'])->name('riwayat')->middleware('role:pasien');
    Route::get('/riwayat/detail/{id}', [ReservasiController::class, 'detailRiwayat'])->name('riwayat.detail')->middleware('role:pasien');

    // ==================== FEEDBACK PASIEN ====================
    Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create')->middleware('role:pasien');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('role:pasien');
    Route::get('/feedback/success', [FeedbackController::class, 'success'])->name('feedback.success')->middleware('role:pasien');
    Route::get('/feedback/history', [FeedbackController::class, 'history'])->name('feedback.history')->middleware('role:pasien');
});

// ==================== REDIRECT LOGIN KE DASHBOARD SESUAI ROLE ====================
Route::get('/redirect', function () {
    if (!auth()->check()) {
        return redirect('/login');
    }
    
    $role = auth()->user()->role;
    
    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    }
    if ($role === 'dokter') {
        return redirect('/dokter/dashboard');
    }
    if ($role === 'pasien') {
        return redirect('/pasien/dashboard');
    }
    
    return redirect('/');
})->name('redirect');