# Prompt untuk Antigravity — Konversi Hasil Figma (HTML/CSS) ke Laravel Blade

Tempel seluruh isi di bawah ini sebagai satu instruksi ke agent Antigravity.
Lampirkan juga file `PRD_SINAU.md` pada context (mention dengan `@`) agar agent
memahami batasan fitur, role, dan istilah yang dipakai secara konsisten.

---

```
Konteks proyek:
Saya sedang membangun sistem e-learning bernama SINAU untuk tugas mata kuliah
Web Framework Laravel. Baca dan pahami dulu file @PRD_SINAU.md sebagai acuan
fitur, role (admin/guru/siswa), dan batasan sistem — JANGAN menambah fitur di
luar dokumen tersebut, dan JANGAN mengubah keputusan arsitektur yang sudah
ditetapkan di sana (Blade, bukan Inertia/React; tanpa AI; tanpa queue).

Saya sudah punya hasil desain dari Figma yang diekspor menjadi HTML + CSS
statis, berlokasi di folder `laravel-export/`, berisi 4 file:
- login.html
- admin.html
- guru.html
- siswa.html

Desain ini menggunakan utility class Tailwind CSS. Tugas Anda: buat project
Laravel baru (jika belum ada) dengan Tailwind CSS sebagai satu-satunya
pendekatan styling (bukan CSS custom terpisah), lalu pindahkan keempat desain
statis ini menjadi struktur Blade template engine Laravel, mengikuti instruksi
berikut secara PERSIS:

LANGKAH KERJA:

1. Inspeksi dulu keempat file HTML tersebut. Identifikasi bagian-bagian yang
   berulang/sama di admin.html, guru.html, dan siswa.html — khususnya:
   - Topbar/header (nama user yang login, tombol keluar)
   - Sidebar navigasi (kontennya berbeda per role, tapi struktur/style-nya
     mengikuti pola yang sama)
   - Elemen alert/notifikasi jika ada
   - Konten <head> (meta tag, class Tailwind yang dipakai berulang) yang
     sama di semua halaman
   Catat juga warna-warna kustom (hex) yang dipakai di luar palet default
   Tailwind, misalnya lewat class arbitrary value seperti `bg-[#1F3D2E]` —
   ini akan didaftarkan sebagai token warna di `tailwind.config.js` pada
   langkah berikutnya, bukan dibiarkan sebagai hex mentah tercecer di Blade.

2. Inisialisasi project Laravel (versi LTS terbaru) dengan Laravel Breeze
   stack Blade (bukan React/Vue/Inertia) untuk autentikasi dasar, jika project
   belum dibuat sebelumnya. Breeze stack Blade sudah menyertakan Tailwind CSS
   + Vite secara default — jangan tambahkan build tool CSS lain.

3. Buat struktur layout Blade sebagai berikut:
   - `resources/views/layouts/guest.blade.php`
     Layout untuk halaman sebelum login (dipakai oleh login.html). Berisi
     kerangka <head> (termasuk link CSS) dan `@yield('content')`.
   - `resources/views/layouts/app.blade.php`
     Layout utama untuk halaman setelah login (dipakai admin/guru/siswa).
     Wajib memakai struktur berikut sesuai instruksi tugas:
       @extends akan dipanggil dari tiap halaman turunan
       Di dalam app.blade.php sendiri, sediakan:
         - `@include('partials.topbar')`
         - Slot sidebar yang menyesuaikan role (lihat langkah 4)
         - `@include('partials.alert')` (untuk pesan sukses/error, bila ada)
         - `@yield('content')` sebagai area konten utama tiap halaman
         - `@yield('title', 'SINAU')` untuk judul halaman di <title>

4. Buat partial di `resources/views/partials/`:
   - `topbar.blade.php` — header atas, tampilkan nama user login
     (`{{ auth()->user()->name }}`) dan tombol keluar (form logout Laravel
     standar).
   - `sidebar-admin.blade.php`, `sidebar-guru.blade.php`,
     `sidebar-siswa.blade.php` — isi menu navigasi sesuai konten asli di
     masing-masing HTML (admin.html, guru.html, siswa.html). Di
     `app.blade.php`, panggil partial sidebar yang sesuai secara dinamis,
     misalnya:
     `@include('partials.sidebar-' . auth()->user()->getRoleNames()->first())`
   - `alert.blade.php` — partial kosong/template sederhana untuk pesan
     flash session (`session('success')`, `session('error')`), meskipun
     belum dipakai aktif di semua halaman.

5. Konversi tiap halaman menjadi Blade view yang extends layout yang sesuai,
   dengan isi konten asli (di luar bagian topbar/sidebar/head yang sudah
   dipindah ke partial/layout) dibungkus `@section('content')...@endsection`:
   - `resources/views/auth/login.blade.php` → extends `layouts.guest`
     (boleh menimpa view Breeze bawaan, sesuaikan markup dari login.html)
   - `resources/views/admin/dashboard.blade.php` → extends `layouts.app`
   - `resources/views/guru/dashboard.blade.php` → extends `layouts.app`
   - `resources/views/siswa/dashboard.blade.php` → extends `layouts.app`

   PENTING: jangan mengubah tampilan visual (warna, font, spacing, layout)
   dari desain asli. Ini murni refactor struktur HTML statis menjadi Blade,
   bukan mendesain ulang.

6. Pertahankan seluruh class Tailwind persis seperti di HTML asli saat
   dipindah ke Blade — jangan diekstrak jadi CSS custom terpisah. Tambahan
   yang wajib dilakukan:
   - Daftarkan warna kustom hasil temuan langkah 1 (misalnya hijau tua,
     krem, terakota) sebagai token warna bernama di `tailwind.config.js`,
     contoh:
     ```js
     theme: {
       extend: {
         colors: {
           'sinau-cream': '#FAF6EF',
           'sinau-green': '#1F3D2E',
           'sinau-terracotta': '#D97B4F',
         }
       }
     }
     ```
   - Ganti setiap class arbitrary value hex mentah (`bg-[#1F3D2E]`) di semua
     Blade view dengan token baru ini (`bg-sinau-green`), supaya perubahan
     warna di masa depan cukup dilakukan di satu tempat
     (`tailwind.config.js`), bukan mencari-cari hex di banyak file.
   - Pastikan `resources/css/app.css` bawaan Breeze tetap berisi
     `@tailwind base; @tailwind components; @tailwind utilities;` dan
     jalankan `npm install && npm run dev` (atau `npm run build` untuk
     produksi) agar Tailwind memproses seluruh class yang dipakai di
     Blade view.

7. Buat routing dasar di `routes/web.php` dengan middleware role (gunakan
   Spatie Laravel-Permission sesuai PRD):
   - `/admin/dashboard` → middleware role:admin → AdminController@dashboard
   - `/guru/dashboard` → middleware role:guru → GuruController@dashboard
   - `/siswa/dashboard` → middleware role:siswa → SiswaController@dashboard
   Buat controller kosong/sederhana yang hanya me-return view terkait untuk
   tahap ini (belum perlu logic bisnis penuh — itu akan dikerjakan bertahap
   mengikuti PRD).

8. PERBAIKAN KONTEN WAJIB (koreksi dari hasil desain Figma):
   Pada halaman guru (bagian "Unggah Materi Pembelajaran"), desain asli dari
   Figma masih menyebut "video" dan menerima file MP4. Sesuai PRD, modul
   materi HANYA berupa dokumen (PDF atau Word), TIDAK ADA video. Saat
   mengonversi halaman ini ke Blade, ubah:
   - Teks deskripsi dari "Unggah modul, video, atau slide untuk diakses
     siswa." menjadi "Unggah dokumen materi (PDF atau Word) untuk diakses
     siswa."
   - Teks keterangan format file dari "PDF, PPT, MP4, hingga 200MB" menjadi
     "PDF atau Word (DOC/DOCX), hingga 20MB"
   - Atribut `accept` pada input file (jika sudah ada input file sungguhan)
     dibatasi ke `.pdf,.doc,.docx` saja.
   Jangan mengubah bagian lain dari desain ini — hanya bagian terkait
   video/MP4 yang perlu disesuaikan.

9. Setelah selesai, jalankan `php artisan serve` dan pastikan ketiga
   dashboard (admin, guru, siswa) serta halaman login tampil identik secara
   visual dengan file HTML asli, namun sekarang sudah berbasis Blade dengan
   `@extends`, `@section`, `@include`, dan `@yield` sesuai instruksi tugas.

Setelah selesai, tampilkan ringkasan struktur folder `resources/views/` yang
terbentuk, dan sebutkan bagian mana saja yang masih berupa placeholder/dummy
(misalnya controller yang belum berisi logic penuh) agar saya tahu apa yang
perlu dikerjakan di iterasi berikutnya.
```

---

## Catatan
- Prompt ini sudah disesuaikan untuk pendekatan **Tailwind CSS** (bukan CSS
  custom terpisah), sesuai keputusan terbaru. Warna kustom didaftarkan
  sebagai token di `tailwind.config.js` agar mudah diubah nanti — lihat file
  `Panduan_Edit_Tampilan_SINAU.md` untuk cara mengubah warna/posisi elemen
  setelah konversi selesai.
- Poin 8 sengaja saya tulis eksplisit sebagai instruksi terpisah supaya agent
  tidak melewatkannya — ini satu-satunya bagian yang mengubah **konten**,
  bukan sekadar struktur.
