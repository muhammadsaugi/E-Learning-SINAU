# Product Requirements Document (PRD)
# SINAU — Sistem E-Learning Kelas, Ujian, dan Sertifikasi untuk Jenjang SMA

**Versi:** 1.0
**Status:** Disetujui untuk pengembangan
**Tujuan dokumen:** Dokumen ini adalah acuan tunggal (single source of truth) untuk pengembangan sistem SINAU. Semua keputusan fitur, arsitektur, dan batasan yang tercantum di sini bersifat final untuk tahap pengembangan ini — jangan menambah, mengurangi, atau mengubah cakupan (scope) tanpa instruksi eksplisit dari pengguna.

---

## 1. Ringkasan Proyek

SINAU adalah sistem pembelajaran daring (e-learning) berbasis web yang menghubungkan guru dan siswa jenjang SMA dalam satu platform: kelas online, materi pembelajaran, diskusi, bank soal, ujian, dan sertifikat digital otomatis.

Proyek ini adalah **tugas mata kuliah Web Framework Laravel**. Konteks ini penting dan memengaruhi seluruh keputusan teknis di dokumen ini:

- Fokus pada penguasaan fitur inti Laravel (routing, Eloquent ORM, Blade, middleware, autentikasi, relasi database, file storage, generate PDF).
- **Tidak melibatkan AI/Machine Learning dalam bentuk apa pun** pada versi ini.
- Arsitektur harus **sederhana dan mudah dipelihara**, bukan arsitektur skala enterprise atau microservices.

## 2. Tujuan & Non-Tujuan

### 2.1 Tujuan (Goals)
- Guru dapat mengelola kelas, materi, bank soal, dan ujian secara mandiri.
- Siswa dapat belajar, berdiskusi, mengikuti ujian, dan mendapatkan sertifikat dalam satu alur yang jelas.
- Sistem menerbitkan sertifikat secara otomatis (rule-based), tanpa proses manual dari siswa.
- Kode mudah dipahami dan dikembangkan lanjut oleh siapa pun yang membaca proyek ini (nilai edukasi, bukan hanya nilai fungsional).

### 2.2 Non-Tujuan (Out of Scope) — WAJIB DIPATUHI
- **Tidak ada AI/ML** (tidak ada rekomendasi otomatis, tidak ada auto-grading esai berbasis AI, tidak ada chatbot).
- **Tidak ada pembayaran/monetisasi.**
- **Tidak ada live streaming atau video conference.**
- **Tidak ada multi-tenant** (sistem untuk satu sekolah/instansi, bukan SaaS multi-sekolah).
- **Tidak ada notifikasi real-time berbasis WebSocket** (cukup notifikasi in-app sederhana bila diperlukan).
- **Tidak ada job queue/worker terpisah** (Redis, Horizon, dll.) — semua proses berjalan secara sinkron.
- **Tidak ada API terpisah untuk mobile app** — sistem adalah aplikasi web server-rendered.

Jika ada permintaan pengembangan yang mengarah ke salah satu poin di atas, tandai sebagai di luar cakupan PRD ini dan konfirmasi ke pengguna sebelum mengerjakan.

## 3. Peran Pengguna (Roles)

| Role | Deskripsi |
|---|---|
| `admin` | Mengelola akun guru & siswa, memantau seluruh kelas dan aktivitas sistem. |
| `guru` | Membuat & mengelola kelas, materi, bank soal, kuis, menilai esai, mengelola diskusi. |
| `siswa` | Bergabung ke kelas, belajar materi, berdiskusi, mengikuti kuis, mengunduh sertifikat. |

Implementasi peran menggunakan **Spatie Laravel-Permission**. Satu user memiliki tepat satu role utama.

## 4. Arsitektur & Keputusan Teknis (WAJIB DIIKUTI)

Bagian ini adalah kontrak teknis. Jangan mengganti pendekatan berikut kecuali diminta eksplisit oleh pengguna.

| Aspek | Keputusan | Alasan |
|---|---|---|
| Framework | Laravel (versi LTS terbaru yang tersedia) | Sesuai mata kuliah |
| Pola arsitektur | MVC monolitik, satu aplikasi | Sederhana, mudah dipelihara |
| Frontend/View | **Blade template** (bukan Inertia, bukan React/Vue SPA) | Mengurangi lapisan kompleksitas yang tidak dibutuhkan untuk tugas ini |
| Styling | Tailwind CSS (boleh dipakai murni untuk styling, bukan sebagai framework JS) | Umum dipakai bersama Blade, tidak menambah kompleksitas arsitektur |
| Database | MySQL/MariaDB tunggal | Satu sumber data, tidak ada database terpisah per fitur |
| Autentikasi | Laravel Breeze (Blade stack) | Bawaan Laravel, minim konfigurasi |
| Otorisasi & role | Spatie Laravel-Permission | Standar de-facto di ekosistem Laravel |
| Penyimpanan berkas | Laravel Storage — disk `public` lokal | Tidak perlu cloud storage (S3, dll.) untuk tugas ini |
| Generate PDF sertifikat | DomPDF (`barryvdh/laravel-dompdf`) | Ringan, tidak butuh dependency eksternal berat |
| Pemicu penerbitan sertifikat | **Model Observer / Event-Listener**, dijalankan **sinkron** saat nilai kuis final tersimpan | Tidak butuh queue worker |
| Background job/queue | **Tidak digunakan** | Di luar cakupan; semua proses berjalan langsung dalam request-response |
| Realtime/WebSocket | **Tidak digunakan** | Di luar cakupan |
| AI/ML | **Tidak digunakan dalam bentuk apa pun** | Di luar cakupan mata kuliah ini |

## 5. Modul Fungsional & Kebutuhan Detail

### 5.1 Modul Autentikasi & Manajemen Pengguna
- Registrasi akun (default role saat registrasi mandiri: `siswa`). Akun `guru` dan `admin` dibuat oleh `admin` melalui panel manajemen pengguna.
- Login/logout standar Laravel Breeze.
- Admin dapat: membuat, mengedit, menonaktifkan akun guru dan siswa.
- Middleware role membatasi akses halaman sesuai role (`admin`, `guru`, `siswa`).

### 5.2 Modul Kelas & Enrollment
**Aktor: Guru, Siswa, Admin**

Fitur Guru:
- Membuat kelas baru: `nama_kelas`, `mata_pelajaran`, `deskripsi`, `kode_kelas` (unik, digenerate otomatis, misal 6 karakter alfanumerik).
- Mengedit/menghapus/mengarsipkan kelas.
- Melihat daftar siswa yang tergabung beserta persentase progres belajar per siswa.
- Mengatur mode enrollment kelas: `kode_langsung` (siswa auto-masuk dengan kode) atau `perlu_approval` (guru menyetujui permintaan gabung).

Fitur Siswa:
- Mencari/memasukkan kode kelas untuk bergabung.
- Melihat daftar kelas yang diikuti beserta progres masing-masing.
- Keluar dari kelas (opsional, hanya jika diminta).

Aturan bisnis:
- Relasi many-to-many antara `users` (siswa) dan `kelas`, melalui tabel pivot `enrollments` dengan status (`pending`, `aktif`, `ditolak`).
- Progres siswa per kelas = (jumlah materi yang ditandai selesai oleh siswa) / (total materi di kelas) × 100%.

### 5.3 Modul Materi & Diskusi
**Aktor: Guru, Siswa**

Fitur Guru:
- Menambahkan materi ke kelas: `judul`, `deskripsi`, `urutan` (angka urut tampil), `file` (upload PDF) dan/atau `url_video` (tautan eksternal, misal YouTube).
- Mengedit urutan materi (reorder).
- Melihat & mengelola komentar pada tiap materi (menandai "terjawab", pin komentar).

Fitur Siswa:
- Mengakses materi sesuai urutan (materi berikutnya dapat diakses meskipun materi sebelumnya belum selesai — **tidak mengunci urutan secara ketat**, kecuali pengguna memutuskan lain).
- Menandai materi sebagai "selesai dipelajari" (tombol manual oleh siswa, disimpan di tabel `progres_materi`).
- Menulis komentar/pertanyaan pada materi, membalas komentar siswa/guru lain (flat comment dengan `parent_id` untuk mendukung satu level balasan — tidak perlu nested reply berjenjang banyak).

### 5.4 Modul Bank Soal & Kuis/Ujian
**Aktor: Guru, Siswa**

Fitur Guru — Bank Soal:
- Menambahkan soal ke bank soal per kelas: `pertanyaan`, `tipe` (`pilihan_ganda` atau `esai`), untuk pilihan ganda: `opsi_a` s.d. `opsi_d` dan `kunci_jawaban`.
- Mengedit/menghapus soal.

Fitur Guru — Kuis:
- Membuat sesi kuis: `judul`, `jumlah_soal_diambil` (diacak dari bank soal), `durasi_menit`, `passing_grade`, `kelas_id`.
- Melihat hasil seluruh siswa untuk satu sesi kuis: skor, waktu pengerjaan, status lulus/tidak.
- Menilai soal esai secara manual (memberi skor per jawaban esai).
- Melihat statistik sederhana: soal dengan tingkat jawaban salah tertinggi (dihitung dari jumlah jawaban salah / jumlah pengerjaan).

Fitur Siswa:
- Memulai kuis (soal diacak dan disimpan urutannya khusus untuk sesi pengerjaan siswa tersebut, disimpan di tabel `hasil_kuis` beserta jawaban per soal).
- Timer otomatis mengunci/mengirim jawaban saat waktu habis.
- Melihat skor langsung untuk soal pilihan ganda; skor esai muncul setelah dinilai guru.
- Melihat riwayat seluruh percobaan kuis miliknya.

Aturan bisnis:
- Skor pilihan ganda dihitung otomatis: `(jumlah_benar / total_soal) × 100`.
- Jika kuis memiliki soal esai, skor akhir = rata-rata tertimbang skor pilihan ganda dan skor esai (bobot sederhana, misal 50:50, dapat dikonfigurasi guru saat membuat kuis).
- Status lulus jika `skor_akhir >= passing_grade`.

### 5.5 Modul Sertifikat Otomatis
**Aktor: Sistem (otomatis), Siswa, Guru**

- Sertifikat diterbitkan otomatis ketika **kedua syarat berikut terpenuhi** untuk siswa pada satu kelas:
  1. Progres materi kelas = 100% (semua materi ditandai selesai).
  2. Terdapat minimal satu hasil kuis dengan status lulus (`skor_akhir >= passing_grade`) pada kelas tersebut.
- Mekanisme: gunakan **Observer** pada model `ProgresMateri` dan `HasilKuis` — setiap kali data disimpan, jalankan pengecekan kedua syarat di atas untuk siswa & kelas terkait. Jika terpenuhi dan sertifikat belum pernah diterbitkan, buat record `sertifikat` dan generate file PDF menggunakan DomPDF secara sinkron (tanpa queue).
- Isi sertifikat PDF: nama siswa, nama kelas/mata pelajaran, tanggal kelulusan, nama sekolah (placeholder/konfigurasi), kode verifikasi unik (misal UUID atau kombinasi acak 10 karakter).
- Halaman publik sederhana `/verifikasi/{kode}` untuk mengecek keaslian sertifikat tanpa perlu login.
- Siswa dapat mengunduh sertifikat dari dashboard pribadinya.
- Sertifikat hanya diterbitkan satu kali per pasangan (siswa, kelas) — tidak ada duplikasi.

## 6. Skema Data (Acuan untuk Migration Laravel)

Tabel di bawah ini adalah acuan kolom utama. Nama tabel gunakan bentuk jamak snake_case sesuai konvensi Laravel.

**users** — id, name, email, password, role (via Spatie, bukan kolom langsung), timestamps

**kelas** — id, guru_id (FK users), nama_kelas, mata_pelajaran, deskripsi, kode_kelas (unique), mode_enrollment (enum: kode_langsung/perlu_approval), timestamps

**enrollments** — id, kelas_id (FK), siswa_id (FK users), status (enum: pending/aktif/ditolak), timestamps

**materi** — id, kelas_id (FK), judul, deskripsi, urutan (integer), file_path (nullable), url_video (nullable), timestamps

**progres_materi** — id, materi_id (FK), siswa_id (FK users), selesai_pada (timestamp nullable), timestamps

**komentar** — id, materi_id (FK), user_id (FK), parent_id (nullable, FK ke komentar), isi, is_pinned (boolean), is_terjawab (boolean), timestamps

**bank_soal** — id, kelas_id (FK), tipe (enum: pilihan_ganda/esai), pertanyaan, opsi_a, opsi_b, opsi_c, opsi_d (nullable untuk esai), kunci_jawaban (nullable untuk esai), timestamps

**kuis** — id, kelas_id (FK), judul, jumlah_soal_diambil, durasi_menit, passing_grade, bobot_pg (default 100 jika tanpa esai), timestamps

**hasil_kuis** — id, kuis_id (FK), siswa_id (FK users), soal_urutan (JSON, daftar id soal yang diacak untuk siswa ini), jawaban (JSON), skor_pg (nullable), skor_esai (nullable), skor_akhir (nullable), status (enum: berlangsung/selesai/dinilai), mulai_pada, selesai_pada, timestamps

**sertifikat** — id, siswa_id (FK users), kelas_id (FK), kode_verifikasi (unique), file_path, diterbitkan_pada, timestamps

> Catatan: skema ini adalah acuan konsep, bukan migration final. Penyesuaian nama kolom/tipe data yang wajar (mengikuti best practice Laravel) diperbolehkan, selama **struktur relasi dan logika bisnis di atas tidak berubah**.

## 7. Alur Pengguna Utama (Ringkas)

**Alur Guru:** Login → Buat kelas → Upload materi → Buat bank soal → Buat sesi kuis → Pantau progres & nilai siswa → Nilai esai (jika ada) → Review penerbitan sertifikat.

**Alur Siswa:** Login → Gabung kelas via kode → Pelajari materi & tandai selesai → Diskusi di kolom komentar → Kerjakan kuis → Lihat skor → (Jika syarat terpenuhi) Unduh sertifikat otomatis.

## 8. Kebutuhan Non-Fungsional
- Kode mengikuti struktur default Laravel (app/Models, app/Http/Controllers, resources/views) — tidak perlu pola arsitektur tambahan (Repository Pattern, Service Layer kompleks, dsb.) kecuali dibutuhkan untuk kejelasan kode.
- Validasi input menggunakan Laravel Form Request.
- Otorisasi akses per fitur menggunakan Laravel Policy/Gate dikombinasikan dengan middleware role dari Spatie.
- Tidak perlu optimasi performa tingkat lanjut (caching, load balancing) — skala pengguna adalah lingkup satu sekolah.

## 9. Kriteria Penerimaan (Acceptance Criteria) — Ringkas per Modul
- **Kelas & Enrollment**: Guru bisa membuat kelas dan mendapat kode unik; siswa bisa join dengan kode; progres per siswa tampil akurat di dashboard guru.
- **Materi & Diskusi**: Materi tampil berurutan; siswa bisa menandai selesai; komentar tersimpan dan tampil dengan balasan satu level.
- **Bank Soal & Kuis**: Guru bisa membuat soal & sesi kuis; siswa mendapat soal acak; skor pilihan ganda muncul otomatis setelah submit; guru bisa menilai esai.
- **Sertifikat**: Sertifikat otomatis terbit saat kedua syarat terpenuhi, tidak ada duplikasi, dan dapat diverifikasi lewat halaman publik.

## 10. Catatan Penting untuk Claude Code
- Dokumen ini adalah batasan cakupan yang telah disetujui pengguna. Jangan menambahkan fitur di luar dokumen ini (termasuk fitur "bagus untuk ditambahkan") tanpa konfirmasi eksplisit.
- Jika ada bagian yang ambigu, tanyakan ke pengguna alih-alih mengambil asumsi yang mengubah arsitektur di Bagian 4.
- Prioritaskan kesederhanaan implementasi dibanding pola desain yang canggih — proyek ini bertujuan untuk kemudahan pemeliharaan dan pemahaman, sesuai konteks tugas mata kuliah.
