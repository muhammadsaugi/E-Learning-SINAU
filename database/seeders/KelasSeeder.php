<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guru = User::where('role', 'guru')->first();
        $guruId = $guru ? $guru->id : 1;

        // 1. Buat Kelas-kelas
        $kelas1 = Kelas::updateOrCreate(
            ['kode_kelas' => 'MTH10A'],
            [
                'guru_id'        => $guruId,
                'nama_kelas'     => 'Matematika 10A',
                'mata_pelajaran' => 'Matematika',
                'deskripsi'      => 'Pembelajaran aljabar dan trigonometri dasar',
            ]
        );

        $kelas2 = Kelas::updateOrCreate(
            ['kode_kelas' => 'BIO11B'],
            [
                'guru_id'        => $guruId,
                'nama_kelas'     => 'Kelas 11 IPA 2',
                'mata_pelajaran' => 'Biologi',
                'deskripsi'      => 'Pembelajaran struktur sel dan genetik',
            ]
        );

        $kelas3 = Kelas::updateOrCreate(
            ['kode_kelas' => 'KMA12A'],
            [
                'guru_id'        => $guruId,
                'nama_kelas'     => 'Kelas 12 IPA 4',
                'mata_pelajaran' => 'Kimia',
                'deskripsi'      => 'Pembelajaran Termokimia dan Elektrokimia',
            ]
        );

        // 2. Buat Contoh Kuis
        $kuis1 = Kuis::updateOrCreate(
            ['judul' => 'Kuis 1: Pengenalan Aljabar & Fungsi'],
            [
                'kelas_id'      => $kelas1->id,
                'durasi_menit'  => 20,
                'passing_grade' => 70,
            ]
        );

        // 3. Buat Contoh Soal Pilihan Ganda & Esai
        Soal::updateOrCreate(
            ['pertanyaan' => 'Jika f(x) = 2x + 5, berapakah nilai dari f(3)?'],
            [
                'kuis_id'       => $kuis1->id,
                'tipe'          => 'pilihan_ganda',
                'opsi_a'        => '9',
                'opsi_b'        => '11',
                'opsi_c'        => '15',
                'opsi_d'        => '21',
                'kunci_jawaban' => 'B',
            ]
        );

        Soal::updateOrCreate(
            ['pertanyaan' => 'Manakah yang merupakan bentuk persamaan kuadrat?'],
            [
                'kuis_id'       => $kuis1->id,
                'tipe'          => 'pilihan_ganda',
                'opsi_a'        => 'x^2 + 4x + 4 = 0',
                'opsi_b'        => '2x + 3 = 7',
                'opsi_c'        => 'y = 5x',
                'opsi_d'        => 'x^3 - 1 = 0',
                'kunci_jawaban' => 'A',
            ]
        );

        Soal::updateOrCreate(
            ['pertanyaan' => 'Jelaskan dengan singkat apa yang dimaksud dengan variabel dalam aljabar!'],
            [
                'kuis_id'       => $kuis1->id,
                'tipe'          => 'esai',
                'opsi_a'        => null,
                'opsi_b'        => null,
                'opsi_c'        => null,
                'opsi_d'        => null,
                'kunci_jawaban' => 'Simbol atau huruf pengganti nilai yang belum diketahui nilainya.',
            ]
        );
    }
}