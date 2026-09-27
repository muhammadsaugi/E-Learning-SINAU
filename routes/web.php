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

// Dashboard Guru & Fitur Kelas (Create, Read, Delete)
Route::get('/guru', [KelasController::class, 'index'])->name('guru');
Route::post('/guru/kelas', [KelasController::class, 'store'])->name('guru.kelas.store');
Route::delete('/guru/kelas/{id}', [KelasController::class, 'destroy'])->name('guru.kelas.destroy');

// Fitur Materi (Create, Delete, Download)
Route::post('/guru/materi', [MateriController::class, 'store'])->name('guru.materi.store');
Route::delete('/guru/materi/{id}', [MateriController::class, 'destroy'])->name('guru.materi.destroy');
Route::get('/materi/download/{id}', [MateriController::class, 'download'])->name('materi.download');

// Fitur Kuis & Soal Guru (Create, Delete, Tambah Butir Soal PG / Esai)
Route::post('/guru/kuis', [KuisController::class, 'store'])->name('guru.kuis.store');
Route::delete('/guru/kuis/{id}', [KuisController::class, 'destroy'])->name('guru.kuis.destroy');
Route::post('/guru/soal', [KuisController::class, 'storeSoal'])->name('guru.soal.store');
Route::delete('/guru/soal/{id}', [KuisController::class, 'destroySoal'])->name('guru.soal.destroy');

// Fitur Pengerjaan Kuis Siswa (Submit Jawaban)
Route::post('/siswa/kuis/{id}/submit', [KuisController::class, 'submitJawaban'])->name('siswa.kuis.submit');
