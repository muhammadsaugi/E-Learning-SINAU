<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Soal;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    /**
     * INDEX: Menampilkan daftar kuis (Read Data)
     */
    public function index(Request $request)
    {
        $kelasList = Kelas::all();
        $kuisList  = Kuis::with(['kelas', 'soal'])->latest()->get();

        if (!$request->wantsJson() && !$request->has('standalone')) {
            return redirect('/guru#banksoal');
        }

        return view('guru.kuis.index', compact('kuisList', 'kelasList'));
    }

    /**
     * CREATE: Menampilkan halaman formulir buat kuis dan ujian
     */
    public function create()
    {
        $kelasList = Kelas::all();
        return view('guru.kuis.create', compact('kelasList'));
    }

    /**
     * STORE: Menyimpan kuis baru dengan validasi lengkap (Create Data).
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

        return redirect('/guru#banksoal')->with('success', 'Kuis baru berhasil dibuat! Silakan tambahkan butir soal di bawah.');
    }

    /**
     * SHOW: Menampilkan detail kuis beserta butir soal (Read by ID)
     */
    public function show($id)
    {
        $kuis = Kuis::with(['kelas', 'soal'])->findOrFail($id);
        return view('guru.kuis.show', compact('kuis'));
    }

    /**
     * EDIT: Menampilkan halaman formulir edit kuis
     */
    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kelasList = Kelas::all();
        return view('guru.kuis.edit', compact('kuis', 'kelasList'));
    }

    /**
     * UPDATE: Memperbarui informasi kuis (Update Data)
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
     * DESTROY: Menghapus kuis beserta seluruh soalnya (Delete Data)
     */
    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->delete();

        return redirect('/guru#banksoal')->with('success', 'Kuis berhasil dihapus!');
    }

    /**
     * Khusus: Menyimpan butir pertanyaan kuis (Pilihan Ganda atau Esai).
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

        return redirect()->back()->with('success', 'Butir soal berhasil ditambahkan ke kuis!');
    }

    /**
     * Khusus: Hapus butir soal.
     */
    public function destroySoal($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return redirect()->back()->with('success', 'Butir soal berhasil dihapus!');
    }

    /**
     * Khusus: Submit jawaban kuis oleh siswa.
     */
    public function submitJawaban(Request $request, $id)
    {
        $kuis = Kuis::with('soal')->findOrFail($id);
        $jawabanSiswa = $request->input('jawaban', []);

        $totalSoal = $kuis->soal->count();
        $benar = 0;

        foreach ($kuis->soal as $soal) {
            if ($soal->tipe === 'pilihan_ganda') {
                $jawab = $jawabanSiswa[$soal->id] ?? null;
                if ($jawab && strtoupper(trim($jawab)) === strtoupper(trim($soal->kunci_jawaban))) {
                    $benar++;
                }
            }
        }

        $skor = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;
        $lulus = $skor >= $kuis->passing_grade;

        $siswaId = auth()->id() ?? 3;
        \App\Models\Nilai::updateOrCreate(
            ['kuis_id' => $kuis->id, 'siswa_id' => $siswaId],
            ['nilai' => $skor, 'status' => $lulus ? 'lulus' : 'remedial']
        );

        $statusMsg = $lulus ? "Selamat, Anda LULUS!" : "Nilai Anda di bawah KKM ({$kuis->passing_grade}), silakan remedial.";
        return redirect()->route('siswa')->with('success', "Kuis selesai! Skor Anda: {$skor} / 100. {$statusMsg}");
    }
}
