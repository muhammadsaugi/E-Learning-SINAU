<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login / pilih role.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses Login manual dengan Email & Password dan pisahkan redirect per role.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Pembedaan redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin')->with('success', 'Selamat datang, Administrator!');
            } elseif ($user->role === 'guru') {
                return redirect()->route('guru')->with('success', 'Selamat datang, Bapak Hendra Kurnia!');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa')->with('success', 'Selamat datang, Kelompok 8!');
            }

            return redirect('/');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    /**
     * Quick Login via klik kartu role (Fitur Praktis untuk Presentasi/Demo).
     */
    public function loginAs($role)
    {
        $user = User::where('role', $role)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            if ($role === 'admin') {
                return redirect()->route('admin')->with('success', 'Login berhasil sebagai Admin');
            } elseif ($role === 'guru') {
                return redirect()->route('guru')->with('success', 'Login berhasil sebagai Guru');
            } elseif ($role === 'siswa') {
                return redirect()->route('siswa')->with('success', 'Login berhasil sebagai Siswa');
            }
        }

        return redirect('/');
    }

    /**
     * Proses Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
