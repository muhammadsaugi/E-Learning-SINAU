<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman login / pilih role.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman dashboard Admin.
     */
    public function admin()
    {
        return view('admin.dashboard');
    }

    /**
     * Menampilkan halaman dashboard Guru.
     */
    public function guru()
    {
        return view('guru.dashboard');
    }

    /**
     * Menampilkan halaman dashboard Siswa.
     */
    public function siswa()
    {
        return view('siswa.dashboard');
    }
}
