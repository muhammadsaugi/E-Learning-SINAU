<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * 1. INDEX: Menampilkan daftar materi (Read Data).
     */
    public function index(Request $request)
    {
        $materiList = Materi::with('kelas')->latest()->get();
        $kelasList  = Kelas::all();

        // Jika diakses dari dashboard tab, arahkan ke tab materi
        if (!$request->wantsJson() && !$request->has('standalone')) {
            return redirect('/guru#materi');
        }

        return view('guru.materi.index', compact('materiList', 'kelasList'));
    }

    /**
     * 2. CREATE: Menampilkan halaman formulir unggah materi baru.
     */
    public function create()
    {
        $kelasList = Kelas::all();
        return view('guru.materi.create', compact('kelasList'));
    }

    /**
     * 3. STORE: Menyimpan materi pembelajaran baru (Create Data).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'judul'       => 'required|string|min:3|max:255',
            'deskripsi'   => 'nullable|string|max:1000',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ], [
            'kelas_id.required'   => 'Silakan pilih kelas terlebih dahulu.',
            'kelas_id.exists'     => 'Kelas yang dipilih tidak valid.',
            'judul.required'      => 'Judul materi wajib diisi.',
            'judul.min'           => 'Judul materi minimal harus 3 karakter.',
            'file_materi.mimes'   => 'Format file harus berupa PDF, DOC, DOCX, PPT, PPTX, atau ZIP.',
            'file_materi.max'     => 'Ukuran file maksimal adalah 20MB.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('materi', 'public');
        }

        Materi::create([
            'kelas_id'  => $validated['kelas_id'],
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $filePath,
        ]);

        return redirect('/guru#materi')->with('success', 'Materi baru berhasil diunggah!');
    }

    /**
     * 4. SHOW: Menampilkan detail materi tertentu (Read by ID).
     */
    public function show($id)
    {
        $materi = Materi::with('kelas')->findOrFail($id);
        return view('guru.materi.show', compact('materi'));
    }

    /**
     * 5. EDIT: Menampilkan halaman formulir edit materi.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $kelasList = Kelas::all();
        return view('guru.materi.edit', compact('materi', 'kelasList'));
    }

    /**
     * 6. UPDATE: Memperbarui data materi pembelajaran (Update Data).
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'judul'       => 'required|string|min:3|max:255',
            'deskripsi'   => 'nullable|string|max:1000',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ], [
            'kelas_id.required'   => 'Silakan pilih kelas terlebih dahulu.',
            'kelas_id.exists'     => 'Kelas yang dipilih tidak valid.',
            'judul.required'      => 'Judul materi wajib diisi.',
            'judul.min'           => 'Judul materi minimal harus 3 karakter.',
            'file_materi.mimes'   => 'Format file harus berupa PDF, DOC, DOCX, PPT, PPTX, atau ZIP.',
            'file_materi.max'     => 'Ukuran file maksimal adalah 20MB.',
        ]);

        if ($request->hasFile('file_materi')) {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $materi->file_path = $request->file('file_materi')->store('materi', 'public');
        }

        $materi->kelas_id = $validated['kelas_id'];
        $materi->judul = $validated['judul'];
        $materi->deskripsi = $validated['deskripsi'] ?? null;
        $materi->save();

        return redirect('/guru#materi')->with('success', "Materi '{$materi->judul}' berhasil diperbarui!");
    }

    /**
     * 7. DESTROY: Menghapus data materi (Delete Data).
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();

        return redirect('/guru#materi')->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * Khusus: Download berkas materi.
     */
    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        if (!$materi->file_path || !Storage::disk('public')->exists($materi->file_path)) {
            return redirect()->back()->with('error', 'Berkas materi tidak ditemukan di server.');
        }

        return Storage::disk('public')->download($materi->file_path);
    }
}
