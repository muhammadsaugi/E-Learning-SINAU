<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SINAU (Murni Statis Blade)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/guru', function () {
    return view('guru.dashboard');
});

Route::get('/siswa', function () {
    return view('siswa.dashboard');
});
