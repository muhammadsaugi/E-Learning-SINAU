<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Tampilkan dashboard guru beserta daftar kelas dari database.
     */
    public function index()
    {
        $kelasList = Kelas::latest()->get(); 
        return view('guru.dashboard', compact('kelasList'));
    }

    /**
     * Simpan kelas baru yang diinput dari form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
        ]);

        $guru = User::where('role', 'guru')->first();

        Kelas::create([
            'guru_id' => $guru ? $guru->id : 1,
            'nama_kelas' => $request->nama_kelas,
            'mata_pelajaran' => $request->mata_pelajaran,
            'kode_kelas' => strtoupper(Str::random(6)),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('guru')->with('success', 'Kelas baru berhasil dibuat!');
    }

    /**
     * Hapus kelas dari database.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('guru')->with('success', 'Kelas berhasil dihapus!');
    }
}
