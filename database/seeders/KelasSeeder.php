<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'guru')->first();
        $guruId = $guru ? $guru->id : 1;

        $kelasList = [
            [
                'kode_kelas' => 'MTH10A',
                'nama_kelas' => 'Matematika 10A',
                'mata_pelajaran' => 'Matematika',
                'deskripsi' => 'Pembelajaran aljabar dan trigonometri dasar',
            ],
            [
                'kode_kelas' => 'BIO11B',
                'nama_kelas' => 'Kelas 11 IPA 2',
                'mata_pelajaran' => 'Biologi',
                'deskripsi' => 'Pembelajaran struktur sel dan genetik',
            ],
            [
                'kode_kelas' => 'KMA12A',
                'nama_kelas' => 'Kelas 12 IPA 4',
                'mata_pelajaran' => 'Kimia',
                'deskripsi' => 'Pembelajaran Termokimia dan Elektrokimia',
            ],
            [
                'kode_kelas' => 'FIS10B',
                'nama_kelas' => 'Fisika 10B',
                'mata_pelajaran' => 'Fisika',
                'deskripsi' => 'Konsep gerak lurus, vektor, dan hukum Newton',
            ],
            [
                'kode_kelas' => 'IND10C',
                'nama_kelas' => 'Bahasa Indonesia 10C',
                'mata_pelajaran' => 'Bahasa Indonesia',
                'deskripsi' => 'Analisis teks eksposisi, cerpen, dan karya sastra',
            ],
            [
                'kode_kelas' => 'ENG11A',
                'nama_kelas' => 'Bahasa Inggris 11A',
                'mata_pelajaran' => 'Bahasa Inggris',
                'deskripsi' => 'Academic writing, reading comprehension, and speech',
            ],
            [
                'kode_kelas' => 'SEJ11C',
                'nama_kelas' => 'Sejarah Indonesia 11C',
                'mata_pelajaran' => 'Sejarah',
                'deskripsi' => 'Pergerakan nasional dan kemerdekaan Republik Indonesia',
            ],
            [
                'kode_kelas' => 'GEO10A',
                'nama_kelas' => 'Geografi 10A',
                'mata_pelajaran' => 'Geografi',
                'deskripsi' => 'Prinsip geografi, litosfer, dan atmosfer bumi',
            ],
            [
                'kode_kelas' => 'EKO11B',
                'nama_kelas' => 'Ekonomi 11B',
                'mata_pelajaran' => 'Ekonomi',
                'deskripsi' => 'Pendapatan nasional, inflasi, dan kebijakan moneter',
            ],
            [
                'kode_kelas' => 'SOS12C',
                'nama_kelas' => 'Sosiologi 12C',
                'mata_pelajaran' => 'Sosiologi',
                'deskripsi' => 'Perubahan sosial dan globalisasi di masyarakat',
            ],
            [
                'kode_kelas' => 'INF10A',
                'nama_kelas' => 'Informatika 10A',
                'mata_pelajaran' => 'Informatika',
                'deskripsi' => 'Dasar algoritma pemrograman dan logika komputasi',
            ],
            [
                'kode_kelas' => 'MTH11B',
                'nama_kelas' => 'Matematika Peminatan 11B',
                'mata_pelajaran' => 'Matematika',
                'deskripsi' => 'Polinomial dan limit fungsi aljabar',
            ],
            [
                'kode_kelas' => 'FIS12A',
                'nama_kelas' => 'Fisika 12A',
                'mata_pelajaran' => 'Fisika',
                'deskripsi' => 'Gelombang elektromagnetik dan fisika kuantum',
            ],
            [
                'kode_kelas' => 'KMA11C',
                'nama_kelas' => 'Kimia 11C',
                'mata_pelajaran' => 'Kimia',
                'deskripsi' => 'Larutan asam basa dan stoikiometri larutan',
            ],
            [
                'kode_kelas' => 'BIO10A',
                'nama_kelas' => 'Biologi 10A',
                'mata_pelajaran' => 'Biologi',
                'deskripsi' => 'Keanekaragaman hayati dan klasifikasi makhluk hidup',
            ],
            [
                'kode_kelas' => 'SEN10B',
                'nama_kelas' => 'Seni Budaya 10B',
                'mata_pelajaran' => 'Seni Budaya',
                'deskripsi' => 'Apresiasi karya seni rupa dua dimensi dan musik daerah',
            ],
            [
                'kode_kelas' => 'PJK11A',
                'nama_kelas' => 'PJOK 11A',
                'mata_pelajaran' => 'PJOK',
                'deskripsi' => 'Kebugaran jasmani dan teknik dasar permainan bola besar',
            ],
            [
                'kode_kelas' => 'PPN12B',
                'nama_kelas' => 'PPKn 12B',
                'mata_pelajaran' => 'PPKn',
                'deskripsi' => 'Kasus pelanggaran hak dan pengingkaran kewajiban warga negara',
            ],
            [
                'kode_kelas' => 'PKW11C',
                'nama_kelas' => 'Prakarya & Kewirausahaan 11C',
                'mata_pelajaran' => 'Prakarya',
                'deskripsi' => 'Perencanaan usaha kerajinan dan strategi pemasaran produk',
            ],
            [
                'kode_kelas' => 'BJA10A',
                'nama_kelas' => 'Bahasa Jepang 10A',
                'mata_pelajaran' => 'Bahasa Asing',
                'deskripsi' => 'Pengenalan huruf Hiragana, Katakana, dan percakapan dasar',
            ],
        ];

        foreach ($kelasList as $kelas) {
            Kelas::updateOrCreate(
                ['kode_kelas' => $kelas['kode_kelas']],
                [
                    'guru_id' => $guruId,
                    'nama_kelas' => $kelas['nama_kelas'],
                    'mata_pelajaran' => $kelas['mata_pelajaran'],
                    'deskripsi' => $kelas['deskripsi'],
                ]
            );
        }
    }
}