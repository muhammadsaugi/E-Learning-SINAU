<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Kuis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Tampilkan dashboard guru beserta daftar kelas, materi, dan kuis.
     */
    public function index()
    {
        $kelasList = Kelas::latest()->get(); 
        $materiList = Materi::with('kelas')->latest()->get();
        $kuisList = Kuis::with(['kelas', 'soal'])->latest()->get();

        return view('guru.dashboard', compact('kelasList', 'materiList', 'kuisList'));
    }

    /**
     * Simpan kelas baru dengan validasi data form.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $validated = $request->validate([
            'nama_kelas'     => 'required|string|min:3|max:100',
            'mata_pelajaran' => 'required|string|max:100',
            'deskripsi'      => 'nullable|string|max:255',
        ], [
            'nama_kelas.required'     => 'Nama kelas wajib diisi.',
            'nama_kelas.min'          => 'Nama kelas minimal harus 3 karakter.',
            'nama_kelas.max'          => 'Nama kelas maksimal 100 karakter.',
            'mata_pelajaran.required' => 'Mata pelajaran wajib dipilih.',
            'deskripsi.max'           => 'Deskripsi kelas maksimal 255 karakter.',
        ]);

        $guru = User::where('role', 'guru')->first();

        // 2. Simpan ke database
        Kelas::create([
            'guru_id'        => $guru ? $guru->id : 1,
            'nama_kelas'     => $validated['nama_kelas'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kode_kelas'     => strtoupper(Str::random(6)),
            'deskripsi'      => $validated['deskripsi'] ?? null,
        ]);

        return redirect('/guru#kelas')->with('success', 'Kelas baru berhasil dibuat!');
    }

    /**
     * Hapus kelas dari database.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect('/guru#kelas')->with('success', 'Kelas berhasil dihapus!');
    }
}
