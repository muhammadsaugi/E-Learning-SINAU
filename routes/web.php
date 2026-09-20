<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;

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

// Dashboard Guru & Fitur Kelas
Route::get('/guru', [KelasController::class, 'index'])->name('guru');
Route::post('/guru/kelas', [KelasController::class, 'store'])->name('guru.kelas.store');
Route::delete('/guru/kelas/{id}', [KelasController::class, 'destroy'])->name('guru.kelas.destroy');
