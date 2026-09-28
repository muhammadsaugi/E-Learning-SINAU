<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Soal;
use Illuminate\Database\Seeder;

class KuisSeeder extends Seeder
{
    public function run(): void
    {
        $kelas1 = Kelas::where('kode_kelas', 'MTH10A')->first() ?? Kelas::first();
        $kelas2 = Kelas::where('kode_kelas', 'BIO11B')->first() ?? Kelas::skip(1)->first() ?? $kelas1;
        $kelas3 = Kelas::where('kode_kelas', 'FIS10B')->first() ?? Kelas::skip(3)->first() ?? $kelas1;

        if (!$kelas1) {
            return;
        }

        $kuis1 = Kuis::updateOrCreate(
            ['judul' => 'Kuis 1: Pengenalan Aljabar & Fungsi'],
            [
                'kelas_id'      => $kelas1->id,
                'durasi_menit'  => 20,
                'passing_grade' => 70,
            ]
        );

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

        if ($kelas2) {
            $kuis2 = Kuis::updateOrCreate(
                ['judul' => 'Kuis Biologi: Struktur Sel & Organel'],
                [
                    'kelas_id'      => $kelas2->id,
                    'durasi_menit'  => 30,
                    'passing_grade' => 75,
                ]
            );

            Soal::updateOrCreate(
                ['pertanyaan' => 'Organel sel yang berfungsi sebagai tempat respirasi sel dan penghasil energi adalah?'],
                [
                    'kuis_id'       => $kuis2->id,
                    'tipe'          => 'pilihan_ganda',
                    'opsi_a'        => 'Ribosom',
                    'opsi_b'        => 'Mitokondria',
                    'opsi_c'        => 'Lisosom',
                    'opsi_d'        => 'Badan Golgi',
                    'kunci_jawaban' => 'B',
                ]
            );

            Soal::updateOrCreate(
                ['pertanyaan' => 'Bagian sel yang hanya terdapat pada sel tumbuhan dan tidak ada pada sel hewan adalah?'],
                [
                    'kuis_id'       => $kuis2->id,
                    'tipe'          => 'pilihan_ganda',
                    'opsi_a'        => 'Dinding Sel & Kloroplas',
                    'opsi_b'        => 'Membran Sel',
                    'opsi_c'        => 'Nukleus',
                    'opsi_d'        => 'Sitoplasma',
                    'kunci_jawaban' => 'A',
                ]
            );
        }

        if ($kelas3) {
            $kuis3 = Kuis::updateOrCreate(
                ['judul' => 'Kuis Fisika: Hukum Gerak Newton'],
                [
                    'kelas_id'      => $kelas3->id,
                    'durasi_menit'  => 25,
                    'passing_grade' => 70,
                ]
            );

            Soal::updateOrCreate(
                ['pertanyaan' => 'Sebuah benda dengan massa 5 kg ditarik dengan gaya 20 N. Berapakah percepatan benda tersebut?'],
                [
                    'kuis_id'       => $kuis3->id,
                    'tipe'          => 'pilihan_ganda',
                    'opsi_a'        => '2 m/s²',
                    'opsi_b'        => '4 m/s²',
                    'opsi_c'        => '10 m/s²',
                    'opsi_d'        => '100 m/s²',
                    'kunci_jawaban' => 'B',
                ]
            );
        }
    }
}
