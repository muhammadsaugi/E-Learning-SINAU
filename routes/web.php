<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\KuisController;

/*
|--------------------------------------------------------------------------
| Web Routes — SINAU
|--------------------------------------------------------------------------
*/

// Auth Routes (Login, Quick Role Login, Logout)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/login-as/{role}', [AuthController::class, 'loginAs'])->name('login.as');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::get('/admin', [DashboardController::class, 'admin'])->name('admin');
Route::get('/siswa', [DashboardController::class, 'siswa'])->name('siswa');

// Dashboard Guru
Route::get('/guru', [KelasController::class, 'index'])->name('guru');

// Resource Routes (PBL - Standar Laravel Resource Controller)
Route::resource('kelas', KelasController::class);
Route::resource('materi', MateriController::class);
Route::resource('kuis', KuisController::class);

// Alias group untuk kompatibilitas route prefix 'guru.*'
Route::prefix('guru')->name('guru.')->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('kuis', KuisController::class);
    Route::post('/soal', [KuisController::class, 'storeSoal'])->name('soal.store');
    Route::delete('/soal/{id}', [KuisController::class, 'destroySoal'])->name('soal.destroy');
});

// Route Khusus Tambahan (Download Berkas, Soal Kuis, Submit Jawaban Siswa)
Route::get('/materi/download/{id}', [MateriController::class, 'download'])->name('materi.download');
Route::post('/siswa/kuis/{id}/submit', [KuisController::class, 'submitJawaban'])->name('siswa.kuis.submit');

