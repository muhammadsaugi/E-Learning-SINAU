# 📖 Panduan Lengkap Perintah Laravel Artisan
> Referensi cepat perintah `php artisan` untuk proyek SINAU E-Learning
> Laravel 13.x · PHP 8.x

---

## 📋 Daftar Isi
1. [Menjalankan Server & Vite](#1-menjalankan-server--vite)
2. [Membuat Controller](#2-membuat-controller)
3. [Membuat Model](#3-membuat-model)
4. [Membuat Migration](#4-membuat-migration)
5. [Membuat Sekaligus - Model + Migration + Controller](#5-membuat-sekaligus)
6. [Menjalankan Migration & Database](#6-menjalankan-migration--database)
7. [Database Seeder](#7-database-seeder)
8. [Resource - Route & Controller](#8-resource)
9. [Membuat Komponen Lainnya](#9-membuat-komponen-lainnya)
10. [Cache & Optimasi](#10-cache--optimasi)
11. [Melihat Informasi Proyek](#11-melihat-informasi-proyek)
12. [Perintah Debugging & Maintenance](#12-perintah-debugging--maintenance)
13. [Kombinasi Perintah Berguna](#13-kombinasi-perintah-berguna)
14. [Struktur Folder Penting](#14-struktur-folder-penting)

---

## 1. Menjalankan Server & Vite

```bash
# Jalankan server Laravel (default: localhost:8000)
php artisan serve

# Jalankan di port tertentu
php artisan serve --port=8080

# Jalankan Vite dev server (untuk CSS/JS hot reload)
npm run dev

# Build aset untuk production
npm run build
```

---

## 2. Membuat Controller

```bash
# Controller biasa (kosong)
php artisan make:controller NamaController

# Controller dengan 7 method Resource (index, create, store, show, edit, update, destroy)
php artisan make:controller NamaController --resource

# Controller Resource + type-hint Model
php artisan make:controller NamaController --resource --model=NamaModel

# Controller hanya untuk API (tanpa method create & edit)
php artisan make:controller NamaController --api

# Controller di dalam subfolder
php artisan make:controller Admin/NamaController
```

### 7 Method yang Dihasilkan `--resource`

| Method    | URL                  | HTTP   | Fungsi                  |
|-----------|----------------------|--------|-------------------------|
| `index`   | /nama                | GET    | Tampilkan semua data    |
| `create`  | /nama/create         | GET    | Form tambah data baru   |
| `store`   | /nama                | POST   | Simpan data baru        |
| `show`    | /nama/{id}           | GET    | Tampilkan detail data   |
| `edit`    | /nama/{id}/edit      | GET    | Form edit data          |
| `update`  | /nama/{id}           | PUT    | Simpan perubahan data   |
| `destroy` | /nama/{id}           | DELETE | Hapus data              |

---

## 3. Membuat Model

```bash
# Model biasa
php artisan make:model NamaModel

# Model + Migration
php artisan make:model NamaModel -m

# Model + Migration + Seeder
php artisan make:model NamaModel -m -s

# Model + Migration + Factory
php artisan make:model NamaModel -m -f

# Model + Migration + Seeder + Factory + Controller
php artisan make:model NamaModel -m -s -f -c

# Model + SEMUA (migration, factory, seeder, controller, policy)
php artisan make:model NamaModel --all
```

### Contoh Isi Model Lengkap

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    // Nama tabel (opsional jika sudah sesuai konvensi Laravel)
    protected $table = 'materi';

    // Kolom yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
        'kelas_id',
        'judul',
        'deskripsi',
        'file_path',
    ];

    // Relasi: Materi milik satu Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi: Materi punya banyak Komentar
    public function komentar()
    {
        return $this->hasMany(MateriKomentar::class);
    }
}
```

### Jenis-Jenis Relasi Eloquent

```php
// Satu ke Satu
public function profil() { return $this->hasOne(Profil::class); }

// Banyak ke Satu (milik satu)
public function kelas() { return $this->belongsTo(Kelas::class); }

// Satu ke Banyak
public function materi() { return $this->hasMany(Materi::class); }

// Banyak ke Banyak
public function siswa() { return $this->belongsToMany(User::class, 'kelas_siswa'); }
```

---

## 4. Membuat Migration

```bash
# Migration buat tabel BARU
php artisan make:migration create_nama_tabel_table

# Migration TAMBAH kolom ke tabel existing
php artisan make:migration add_kolom_to_nama_tabel_table

# Migration HAPUS kolom dari tabel
php artisan make:migration remove_kolom_from_nama_tabel_table
```

### Contoh Migration Tabel Baru

```php
public function up(): void
{
    Schema::create('materi', function (Blueprint $table) {
        $table->id();                                        // BIGINT, PK, auto-increment
        $table->foreignId('kelas_id')
              ->constrained('kelas')
              ->cascadeOnDelete();                           // FK ke tabel kelas
        $table->string('judul');                             // VARCHAR 255
        $table->text('deskripsi')->nullable();               // TEXT, boleh null
        $table->string('file_path')->nullable();             // VARCHAR 255, boleh null
        $table->enum('status', ['aktif', 'nonaktif'])
              ->default('aktif');                            // ENUM
        $table->integer('urutan')->default(0);               // INT
        $table->boolean('is_published')->default(false);     // BOOLEAN
        $table->timestamps();                                // created_at & updated_at
        $table->softDeletes();                               // deleted_at (opsional)
    });
}

public function down(): void
{
    Schema::dropIfExists('materi');
}
```

### Contoh Migration Tambah Kolom ke Tabel Existing

```php
public function up(): void
{
    Schema::table('materi', function (Blueprint $table) {
        $table->string('kategori', 50)->nullable()->default('Dokumen')->after('judul');
        $table->integer('view_count')->default(0)->after('kategori');
    });
}

public function down(): void
{
    Schema::table('materi', function (Blueprint $table) {
        $table->dropColumn(['kategori', 'view_count']);
    });
}
```

### Tipe Kolom Umum

| Method                            | Tipe SQL             | Keterangan              |
|-----------------------------------|----------------------|-------------------------|
| `$table->id()`                    | BIGINT PK            | Primary key             |
| `$table->string('nama')`          | VARCHAR(255)         | Teks pendek             |
| `$table->string('nama', 100)`     | VARCHAR(100)         | Teks pendek max 100     |
| `$table->text('isi')`             | TEXT                 | Teks panjang            |
| `$table->longText('konten')`      | LONGTEXT             | Teks sangat panjang     |
| `$table->integer('jml')`          | INT                  | Angka bulat             |
| `$table->bigInteger('angka')`     | BIGINT               | Angka bulat besar       |
| `$table->float('harga')`          | FLOAT                | Angka desimal           |
| `$table->decimal('hrg', 10, 2)`   | DECIMAL(10,2)        | Angka desimal presisi   |
| `$table->boolean('aktif')`        | TINYINT(1)           | True/False              |
| `$table->date('tgl_lahir')`       | DATE                 | Tanggal                 |
| `$table->time('jam')`             | TIME                 | Waktu                   |
| `$table->timestamp('login_at')`   | TIMESTAMP            | Tanggal + waktu         |
| `$table->timestamps()`            | TIMESTAMP x2         | created_at + updated_at |
| `$table->softDeletes()`           | TIMESTAMP            | deleted_at              |
| `$table->enum('s', ['a','b'])`    | ENUM                 | Pilihan tetap           |
| `$table->json('data')`            | JSON                 | Data JSON               |
| `$table->foreignId('user_id')`    | BIGINT (FK)          | Foreign key             |
| `->nullable()`                    | NULL allowed         | Boleh kosong            |
| `->default('nilai')`              | DEFAULT              | Nilai default           |
| `->unique()`                      | UNIQUE               | Nilai unik              |
| `->index()`                       | INDEX                | Index pencarian         |
| `->after('kolom_lain')`           | AFTER                | Posisi setelah kolom    |

---

## 5. Membuat Sekaligus

```bash
# ✅ SINGKATAN TERPENDEK — Model + Migration + Resource Controller
php artisan make:model NamaModel -mcr

# Sama persis dengan perintah panjang di bawah ini:
php artisan make:model NamaModel -m --resource --controller

# Model + Migration + Resource Controller + Seeder + Factory
php artisan make:model NamaModel -mcrfs

# Model + Migration + Resource Controller + Seeder + Factory + Form Request
php artisan make:model NamaModel -mcrfsR

# SEMUA sekaligus (migration, seeder, factory, policy, resource controller, request)
php artisan make:model NamaModel -a

# Contoh nyata (seperti di proyek SINAU):
php artisan make:model Kelas -mcr
php artisan make:model Materi -mcr
php artisan make:model Kuis -mcr
```

### Tabel Semua Flag Shorthand `make:model`

| Flag | Kepanjangan     | Fungsi                                    |
|------|-----------------|-------------------------------------------|
| `-m` | `--migration`   | Buat file migration                       |
| `-c` | `--controller`  | Buat Controller                           |
| `-r` | `--resource`    | Controller jadi Resource (7 method CRUD)  |
| `-s` | `--seed`        | Buat Seeder                               |
| `-f` | `--factory`     | Buat Factory (data dummy)                 |
| `-R` | `--requests`    | Buat Form Request class (validasi)        |
| `-a` | `--all`         | Semua flag di atas sekaligus              |

> 💡 **Tips:** Flag pendek bisa digabung semua dalam satu tanda `-`, contoh: `-mcr`, `-mcrfs`, `-a`.

---

## 6. Menjalankan Migration & Database

```bash
# Jalankan semua migration yang BELUM dijalankan
php artisan migrate

# Jalankan migration + seeder sekaligus
php artisan migrate --seed

# Lihat status migration (sudah jalan atau belum)
php artisan migrate:status

# Rollback migration terakhir (1 batch)
php artisan migrate:rollback

# Rollback sejumlah batch tertentu
php artisan migrate:rollback --step=2

# Rollback SEMUA migration
php artisan migrate:reset

# Rollback semua + migrate ulang (DATA TERHAPUS!)
php artisan migrate:refresh

# migrate:refresh + seeder (DATA TERHAPUS!)
php artisan migrate:refresh --seed

# Hapus semua tabel lalu migrate ulang (DATA TERHAPUS!)
php artisan migrate:fresh

# migrate:fresh + seeder (DATA TERHAPUS!)
php artisan migrate:fresh --seed
```

> ⚠️ **PERINGATAN:** Perintah `migrate:fresh`, `migrate:refresh`, dan `migrate:reset`
> akan **menghapus semua data** di database!
> Gunakan hanya di lingkungan **development**, TIDAK di production!

---

## 7. Database Seeder

```bash
# Buat file Seeder baru
php artisan make:seeder NamaSeeder

# Jalankan semua seeder (yang terdaftar di DatabaseSeeder.php)
php artisan db:seed

# Jalankan seeder tertentu saja
php artisan db:seed --class=NamaSeeder

# Buat Factory untuk data dummy
php artisan make:factory NamaFactory --model=NamaModel
```

### Contoh Isi Seeder

```php
<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create([
            'nama_kelas'     => 'X IPA 1',
            'mata_pelajaran' => 'Matematika',
        ]);

        Kelas::create([
            'nama_kelas'     => 'XI IPA 2',
            'mata_pelajaran' => 'Fisika',
        ]);
    }
}
```

### Daftarkan di DatabaseSeeder.php

```php
public function run(): void
{
    $this->call([
        UserSeeder::class,
        KelasSeeder::class,
        MateriSeeder::class,
        KuisSeeder::class,
    ]);
}
```

---

## 8. Resource

### Daftarkan Route Resource di `routes/web.php`

```php
use App\Http\Controllers\KelasController;

// Resource PENUH (7 route sekaligus)
Route::resource('kelas', KelasController::class);

// Resource hanya method tertentu
Route::resource('kelas', KelasController::class)->only(['index', 'show']);

// Resource kecuali method tertentu
Route::resource('kelas', KelasController::class)->except(['destroy']);

// Resource dalam grup middleware
Route::middleware('auth')->group(function () {
    Route::resource('kelas',  KelasController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('kuis',   KuisController::class);
});

// Resource API (tanpa create & edit)
Route::apiResource('kelas', KelasController::class);
```

### Lihat Semua Route

```bash
php artisan route:list

# Filter berdasarkan nama route
php artisan route:list --name=kelas

# Filter berdasarkan path URL
php artisan route:list --path=kelas
```

---

## 9. Membuat Komponen Lainnya

```bash
# Middleware
php artisan make:middleware NamaMiddleware

# Form Request (Validation class terpisah)
php artisan make:request NamaRequest

# Policy (Otorisasi akses)
php artisan make:policy NamaPolicy --model=NamaModel

# Event
php artisan make:event NamaEvent

# Listener (mendengarkan event)
php artisan make:listener NamaListener --event=NamaEvent

# Job (background queue)
php artisan make:job NamaJob

# Mail
php artisan make:mail NamaMail

# Notification
php artisan make:notification NamaNotification

# Command Artisan kustom
php artisan make:command NamaCommand

# Blade Component
php artisan make:component NamaComponent

# Observer (event model otomatis)
php artisan make:observer NamaObserver --model=NamaModel

# Enum
php artisan make:enum NamaEnum
```

---

## 10. Cache & Optimasi

```bash
# ─── Membersihkan Cache ───────────────────────────────────────

# Bersihkan cache konfigurasi
php artisan config:clear

# Bersihkan cache route
php artisan route:clear

# Bersihkan cache view Blade
php artisan view:clear

# Bersihkan cache aplikasi
php artisan cache:clear

# Bersihkan SEMUA cache sekaligus (paling sering dipakai)
php artisan optimize:clear


# ─── Membuat Cache (untuk Production) ────────────────────────

# Cache konfigurasi
php artisan config:cache

# Cache route
php artisan route:cache

# Cache view
php artisan view:cache

# Optimasi semua sekaligus (config + route + view)
php artisan optimize
```

---

## 11. Melihat Informasi Proyek

```bash
# Versi Laravel
php artisan --version

# Daftar semua perintah artisan
php artisan list

# Bantuan untuk perintah tertentu
php artisan help make:model

# Lihat semua route
php artisan route:list

# Informasi environment (local/production/staging)
php artisan env

# Informasi lengkap aplikasi (PHP, driver, path, dll)
php artisan about

# Masuk ke mode interaktif Tinker (REPL)
php artisan tinker
```

### Contoh Pakai Tinker untuk Test Query

```bash
php artisan tinker

# Di dalam Tinker — coba query langsung:
>>> App\Models\Kelas::all()
>>> App\Models\Materi::with('kelas')->first()
>>> App\Models\User::where('email', 'test@test.com')->first()
>>> App\Models\Materi::count()
>>> exit
```

---

## 12. Perintah Debugging & Maintenance

```bash
# Aktifkan mode maintenance (tampilkan halaman 503)
php artisan down

# Nonaktifkan mode maintenance
php artisan up

# Mode maintenance dengan pesan kustom
php artisan down --message="Sistem sedang dalam pemeliharaan, kembali dalam 5 menit."

# Izinkan akses dari IP tertentu saat maintenance
php artisan down --allow=127.0.0.1

# Generate APP_KEY baru
# (JANGAN dijalankan di production tanpa backup data session/encryption!)
php artisan key:generate

# Buat symbolic link storage ke public
# (wajib agar file yang diupload bisa diakses dari browser)
php artisan storage:link

# Jalankan queue worker (proses background job)
php artisan queue:work

# Lihat antrian job yang gagal
php artisan queue:failed

# Coba ulang semua job yang gagal
php artisan queue:retry all

# Jalankan scheduler (cron job manual)
php artisan schedule:run

# Jalankan scheduler otomatis di background (untuk development)
php artisan schedule:work
```

---

## 13. Kombinasi Perintah Berguna

### Setup Proyek Baru Setelah `git clone`

```bash
composer install
cp .env.example .env
php artisan key:generate
# Buka file .env dan isi: DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan migrate --seed
php artisan storage:link
npm install
npm run dev
php artisan serve
```

### Reset & Isi Ulang Database

```bash
php artisan migrate:fresh --seed
```

### Bersihkan Semua Cache

```bash
php artisan optimize:clear
```

### Buat Fitur CRUD Baru dari Nol

```bash
# Langkah 1: Buat Model + Migration + Resource Controller sekaligus
php artisan make:model Pengumuman -m --resource --controller

# Langkah 2: Daftarkan route di routes/web.php:
#   Route::resource('pengumuman', PengumumanController::class);

# Langkah 3: Isi method up() di file migration yang baru dibuat

# Langkah 4: Jalankan migration
php artisan migrate

# Langkah 5: Buat view Blade di resources/views/pengumuman/
#   - index.blade.php
#   - create.blade.php
#   - edit.blade.php
#   - show.blade.php

# Langkah 6: Isi logic di controller (index, store, update, destroy, dll)
```

### Workflow Setelah `git pull` dari Rekan Tim

```bash
git pull origin main
composer install           # jika ada perubahan composer.json / composer.lock
npm install                # jika ada perubahan package.json
php artisan migrate        # jika ada file migration baru
php artisan optimize:clear # bersihkan cache
npm run dev
php artisan serve
```

### Validasi Lengkap di Controller (Contoh)

```php
$validated = $request->validate([
    'judul'       => 'required|string|min:3|max:255',
    'kelas_id'    => 'required|exists:kelas,id',
    'deskripsi'   => 'nullable|string|max:1000',
    'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:8192',
    'email'       => 'required|email|unique:users,email',
    'password'    => 'required|min:8|confirmed',
    'harga'       => 'required|numeric|min:0',
    'tanggal'     => 'required|date',
    'status'      => 'required|in:aktif,nonaktif',
], [
    'judul.required'    => 'Judul wajib diisi.',
    'judul.min'         => 'Judul minimal 3 karakter.',
    'file_materi.max'   => 'Ukuran file maksimal 8 MB.',
    'email.unique'      => 'Email sudah digunakan.',
]);
```

---

## 14. Struktur Folder Penting

```
project/
├── app/
│   ├── Http/
│   │   ├── Controllers/        ← Controller (logika bisnis)
│   │   ├── Middleware/         ← Middleware (filter request)
│   │   └── Requests/           ← Form Request Validation
│   ├── Models/                 ← Model Eloquent (representasi tabel)
│   └── Providers/              ← Service Provider
│
├── bootstrap/
│   └── app.php                 ← Exception handler & konfigurasi app
│
├── config/                     ← Konfigurasi (database, mail, dll)
│
├── database/
│   ├── migrations/             ← File migration tabel
│   ├── seeders/                ← File seeder data awal
│   └── factories/              ← Factory data dummy
│
├── public/                     ← Root server web (index.php, assets built)
│
├── resources/
│   ├── views/                  ← Template Blade (.blade.php)
│   │   ├── layouts/            ← Layout utama
│   │   ├── partials/           ← Komponen kecil (sidebar, nav)
│   │   └── guru/               ← View per fitur
│   ├── css/app.css             ← CSS source
│   └── js/app.js               ← JavaScript source
│
├── routes/
│   ├── web.php                 ← Route untuk web/browser
│   ├── api.php                 ← Route untuk REST API
│   └── console.php             ← Route untuk command artisan
│
├── storage/
│   └── app/public/             ← File upload (akses via storage:link)
│
├── .env                        ← Konfigurasi environment (JANGAN push ke GitHub!)
├── .env.example                ← Template .env (ini yang di-push)
├── .gitignore                  ← File yang diabaikan git
├── artisan                     ← Entry point CLI Laravel
├── composer.json               ← Dependensi PHP
└── package.json                ← Dependensi Node.js (Vite, dll)
```

---

> 💡 **Tips:**
> - Jalankan `php artisan list` untuk melihat semua perintah yang tersedia.
> - Jalankan `php artisan help <perintah>` untuk melihat penjelasan & opsi suatu perintah.
> - Selalu jalankan `php artisan optimize:clear` setelah mengubah file `.env` atau `config/`.
