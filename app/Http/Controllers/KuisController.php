<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\Soal;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    /**
     * Menyimpan kuis baru dengan validasi lengkap (Create Data).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id'      => 'required|exists:kelas,id',
            'judul'         => 'required|string|min:3|max:255',
            'durasi_menit'  => 'required|integer|min:5|max:180',
            'passing_grade' => 'required|integer|min:0|max:100',
        ], [
            'kelas_id.required'      => 'Silakan pilih kelas untuk kuis ini.',
            'kelas_id.exists'        => 'Kelas yang dipilih tidak valid.',
            'judul.required'         => 'Judul kuis / topik soal wajib diisi.',
            'judul.min'              => 'Judul kuis minimal 3 karakter.',
            'durasi_menit.required'  => 'Durasi pengerjaan kuis wajib diisi.',
            'durasi_menit.integer'   => 'Durasi harus berupa angka (menit).',
            'durasi_menit.min'       => 'Durasi kuis minimal 5 menit.',
            'passing_grade.required' => 'Nilai KKM (Passing Grade) wajib diisi.',
            'passing_grade.min'      => 'Passing grade minimal 0.',
            'passing_grade.max'      => 'Passing grade maksimal 100.',
        ]);

        Kuis::create($validated);

        return redirect('/guru#banksoal')->with('success', 'Kuis / Ujian baru berhasil dibuat! Silakan tambahkan butir soal di bawah.');
    }

    /**
     * Memperbarui informasi kuis (Update Data).
     */
    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        $validated = $request->validate([
            'kelas_id'      => 'required|exists:kelas,id',
            'judul'         => 'required|string|min:3|max:255',
            'durasi_menit'  => 'required|integer|min:5|max:180',
            'passing_grade' => 'required|integer|min:0|max:100',
        ], [
            'kelas_id.required'      => 'Silakan pilih kelas untuk kuis ini.',
            'kelas_id.exists'        => 'Kelas yang dipilih tidak valid.',
            'judul.required'         => 'Judul kuis wajib diisi.',
            'durasi_menit.required'  => 'Durasi pengerjaan kuis wajib diisi.',
            'passing_grade.required' => 'Passing grade wajib diisi.',
        ]);

        $kuis->update($validated);

        return redirect('/guru#banksoal')->with('success', "Kuis '{$kuis->judul}' berhasil diperbarui!");
    }

    /**
     * Menyimpan butir pertanyaan (Pilihan Ganda atau Esai/Teks).
     */
    public function storeSoal(Request $request)
    {
        $validated = $request->validate([
            'kuis_id'       => 'required|exists:kuis,id',
            'pertanyaan'    => 'required|string|min:3',
            'tipe'          => 'required|in:pilihan_ganda,esai',
            'opsi_a'        => 'required_if:tipe,pilihan_ganda|nullable|string',
            'opsi_b'        => 'required_if:tipe,pilihan_ganda|nullable|string',
            'opsi_c'        => 'nullable|string',
            'opsi_d'        => 'nullable|string',
            'kunci_jawaban' => 'required|string',
        ], [
            'kuis_id.required'       => 'Silakan pilih kuis tujuan.',
            'pertanyaan.required'    => 'Pertanyaan soal wajib diisi.',
            'opsi_a.required_if'     => 'Pilihan Opsi A wajib diisi untuk soal pilihan ganda.',
            'opsi_b.required_if'     => 'Pilihan Opsi B wajib diisi untuk soal pilihan ganda.',
            'kunci_jawaban.required' => 'Kunci jawaban benar wajib ditentukan.',
        ]);

        Soal::create($validated);

        return redirect('/guru#banksoal')->with('success', 'Butir soal berhasil ditambahkan ke kuis!');
    }

    /**
     * Hapus kuis beserta seluruh soalnya (Delete Data).
     */
    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect('/guru#banksoal')->with('success', 'Kuis berhasil dihapus!');
    }

    /**
     * Hapus butir soal (Delete Data).
     */
    public function destroySoal($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect('/guru#banksoal')->with('success', 'Butir soal berhasil dihapus!');
    }

    /**
     * Menerima dan mengoreksi jawaban kuis dari siswa secara otomatis.
     */
    public function submitJawaban(Request $request, $id)
    {
        $kuis = Kuis::with('soal')->findOrFail($id);
        $jawabanSiswa = $request->input('jawaban', []);

        $totalSoal = $kuis->soal->count();
        if ($totalSoal === 0) {
            return redirect('/siswa#quiz')->with('error', 'Kuis ini belum memiliki soal untuk dikerjakan.');
        }

        $benar = 0;
        $totalPG = 0;

        foreach ($kuis->soal as $soal) {
            if ($soal->tipe === 'pilihan_ganda') {
                $totalPG++;
                $jawaban = isset($jawabanSiswa[$soal->id]) ? strtoupper(trim($jawabanSiswa[$soal->id])) : null;
                if ($jawaban && $jawaban === strtoupper(trim($soal->kunci_jawaban))) {
                    $benar++;
                }
            } else {
                if (!empty($jawabanSiswa[$soal->id])) {
                    $benar++;
                }
            }
        }

        $skor = round(($benar / $totalSoal) * 100);
        $isLulus = $skor >= $kuis->passing_grade;
        $grade = $skor >= 85 ? 'A' : ($skor >= 70 ? 'B' : ($skor >= 55 ? 'C' : 'D'));

        $siswa = \App\Models\User::where('role', 'siswa')->first();
        $siswaId = auth()->id() ?? ($siswa ? $siswa->id : 3);

        \App\Models\Nilai::updateOrCreate(
            ['siswa_id' => $siswaId, 'kuis_id' => $kuis->id],
            [
                'nilai'  => $skor,
                'status' => $isLulus ? 'lulus' : 'tidak_lulus',
                'grade'  => $grade,
            ]
        );

        $pesan = "Kuis '{$kuis->judul}' selesai! Skor Anda: {$skor}/100 (Grade {$grade}). " . 
                 ($isLulus ? "Selamat, Anda LULUS! 🎉" : "Nilai di bawah KKM ({$kuis->passing_grade}).");

        return redirect('/siswa#nilai')->with('success', $pesan);
    }
}
