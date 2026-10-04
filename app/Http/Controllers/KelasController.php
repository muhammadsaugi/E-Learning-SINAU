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
     * 1. INDEX: Menampilkan daftar data kelas (Read Data).
     * Mendukung pencarian (search) dan memuat ringkasan materi & kuis.
     */
    public function index(Request $request)
    {
        $search = $request->input('q');

        $kelasQuery = Kelas::with(['guru', 'materi', 'kuis']);
        if ($search) {
            $kelasQuery->where(function ($query) use ($search) {
                $query->where('nama_kelas', 'like', "%{$search}%")
                      ->orWhere('mata_pelajaran', 'like', "%{$search}%")
                      ->orWhere('kode_kelas', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        $kelasList = $kelasQuery->latest()->get();

        $materiList = Materi::with('kelas')->latest()->get();
        $kuisList = Kuis::with(['kelas', 'soal'])->latest()->get();

        return view('guru.dashboard', compact('kelasList', 'materiList', 'kuisList', 'search'));
    }

    /**
     * 2. CREATE: Menampilkan halaman formulir tambah kelas baru.
     */
    public function create()
    {
        return view('guru.kelas.create');
    }

    /**
     * 3. STORE: Menyimpan data kelas baru ke database (Create Data).
     */
    public function store(Request $request)
    {
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

        Kelas::create([
            'guru_id'        => $guru ? $guru->id : 1,
            'nama_kelas'     => $validated['nama_kelas'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kode_kelas'     => strtoupper(Str::random(6)),
            'deskripsi'      => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas baru berhasil dibuat!');
    }

    /**
     * 4. SHOW: Menampilkan detail satu kelas tertentu (Read by ID).
     */
    public function show($id)
    {
        $kelas = Kelas::with(['guru', 'materi', 'kuis.soal'])->findOrFail($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json($kelas);
        }

        return view('guru.kelas.show', compact('kelas'));
    }

    /**
     * 5. EDIT: Menampilkan halaman formulir edit kelas.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('guru.kelas.edit', compact('kelas'));
    }

    /**
     * 6. UPDATE: Memperbarui data kelas di database (Update Data).
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

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

        $kelas->update($validated);

        return redirect()->route('kelas.index')->with('success', "Kelas '{$kelas->nama_kelas}' berhasil diperbarui!");
    }

    /**
     * 7. DESTROY: Menghapus data kelas dari database (Delete Data).
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $nama = $kelas->nama_kelas;
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', "Kelas '{$nama}' berhasil dihapus!");
    }
}
