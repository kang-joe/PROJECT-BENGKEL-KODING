<?php

use App\Models\Periksa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

/* --------------- Guest bisa login dan register --------------- */
Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/no-access', function () {
    return view('no-access');
})->name('no-access');

/* --------------- Role Pasien --------------- */
Route::middleware('auth')->group(function () {
    Route::middleware('role:pasien')->group(function () {
        Route::get('/pasien/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');
        Route::get('/pasien/periksa', [PasienController::class, 'showPeriksa'])->name('pasien.periksa');
        Route::post('/pasien/periksa', [PasienController::class, 'storePeriksa'])->name('pasien.periksaPost');
        Route::get('/pasien/riwayat', [PasienController::class, 'showRiwayat'])->name('pasien.riwayat');
    });

    /* --------------- Role Dokter --------------- */
    Route::middleware('role:dokter')->group(function () {
        Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');

        // Obat
        Route::get('/dokter/obat', [DokterController::class, 'showObat'])->name('dokter.obat');
        Route::post('/dokter/obat', [DokterController::class, 'storeObat'])->name('dokter.obatStore');
        Route::get('/dokter/obat/edit/{id}', [DokterController::class, 'editObat'])->name('dokter.obatEdit');
        Route::put('/dokter/obat/update/{id}', [DokterController::class, 'updateObat'])->name('dokter.obatUpdate');  // Gunakan PUT untuk update
        Route::delete('/dokter/obat/delete/{id}', [DokterController::class, 'destroyObat'])->name('dokter.obatDelete');
        
        // Periksa
        Route::get('/dokter/periksa', [DokterController::class, 'showPeriksa'])->name('dokter.periksa');
        Route::get('/dokter/periksa/edit/{id}', [DokterController::class, 'editPeriksa'])->name('dokter.periksa.edit');
        Route::put('/dokter/periksa/update/{id}', [DokterController::class, 'updatePeriksa'])->name('dokter.periksa.update');  // Gunakan PUT untuk update
        Route::delete('/dokter/periksa/obat/{id}', [DokterController::class, 'hapusDetailObat'])->name('dokter.periksa.obat.hapus');
    });
});
