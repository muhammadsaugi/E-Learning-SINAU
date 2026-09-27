<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Menyimpan materi pembelajaran baru dengan validasi lengkap.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Form
        $validated = $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'judul'       => 'required|string|min:3|max:255',
            'deskripsi'   => 'nullable|string|max:1000',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480', // Maks 20MB
        ], [
            'kelas_id.required'   => 'Silakan pilih kelas terlebih dahulu.',
            'kelas_id.exists'     => 'Kelas yang dipilih tidak valid.',
            'judul.required'      => 'Judul materi wajib diisi.',
            'judul.min'           => 'Judul materi minimal harus 3 karakter.',
            'file_materi.mimes'   => 'Format file harus berupa PDF, DOC, DOCX, PPT, PPTX, atau ZIP.',
            'file_materi.max'     => 'Ukuran file maksimal adalah 20MB.',
        ]);

        // 2. Proses upload file jika ada
        $filePath = null;
        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('materi', 'public');
        }

        // 3. Simpan ke database
        Materi::create([
            'kelas_id'  => $validated['kelas_id'],
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $filePath,
        ]);

        return redirect('/guru#materi')->with('success', 'Materi baru berhasil diunggah!');
    }

    /**
     * Hapus materi.
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($materi->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($materi->file_path);
        }
        $materi->delete();

        return redirect('/guru#materi')->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * Download file materi secara aman.
     */
    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        if (!$materi->file_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($materi->file_path)) {
            return redirect()->back()->with('error', 'Berkas materi tidak ditemukan di server.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download($materi->file_path);
    }
}
