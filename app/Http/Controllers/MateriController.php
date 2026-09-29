<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Menyimpan materi pembelajaran baru dengan validasi lengkap (Create Data).
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
     * Memperbarui materi pembelajaran (Update Data).
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
     * Hapus materi (Delete Data).
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
     * Download file materi secara aman.
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
