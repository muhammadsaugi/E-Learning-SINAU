# SINAU — Sistem E-Learning (Laravel Blade + Tailwind CSS)

Platform pembelajaran daring (e-learning) berbasis Laravel dengan pemanfaatan **Blade Template Engine** dan **Tailwind CSS**.

---

## 📋 Prasyarat Sistem (Prerequisites)

Pastikan komputer/laptop Anda telah terpasang:
- **PHP** (>= 8.2)
- **Composer**
- **Node.js** (>= 18) & **NPM**
- **Git**

---

## 🚀 Panduan Instalasi & Menjalankan Project

Ikuti langkah-langkah berikut secara berurutan di terminal:

### 1. Clone Repository
```bash
git clone https://github.com/muhammadsaugi/E-Learning-SINAU.git
cd E-Learning-SINAU
```

### 2. Install Dependency PHP & Node
```bash
composer install
npm install
```

### 3. Setup File Environment & Application Key
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Setup Database & Migrasi
Jika menggunakan SQLite bawaan:
```bash
touch database/database.sqlite
php artisan migrate
```
*(Atau sesuaikan pengaturan database MySQL di file `.env` jika menggunakan MySQL/XAMPP)*

### 5. Jalankan Server Pengembangan (Dev Server)

Buka **2 terminal terpisah**:

- **Terminal 1 (Server Laravel):**
  ```bash
  php artisan serve
  ```

- **Terminal 2 (Vite / Tailwind Asset Compiler):**
  ```bash
  npm run dev
  ```

---

## 🌐 Daftar Halaman yang Dapat Diakses

Buka browser dan akses URL berikut:

| Halaman | URL | Keterangan |
|---|---|---|
| **Login / Beranda** | `http://127.0.0.1:8000/` | Halaman pilih peran (Siswa, Guru, Admin) |
| **Dashboard Admin** | `http://127.0.0.1:8000/admin` | Panel pantau aktivitas & kelola kelas/akun |
| **Dashboard Guru** | `http://127.0.0.1:8000/guru` | Panel kelola materi, soal, nilai & sertifikat |
| **Dashboard Siswa** | `http://127.0.0.1:8000/siswa` | Panel belajar materi, evaluasi kuis & nilai |

---

## 📁 Struktur Template Blade
- `resources/views/layouts/` : Master layout (`app.blade.php`, `guest.blade.php`)
- `resources/views/partials/`: Komponen modular (`topbar`, `sidebar-admin`, `sidebar-guru`, `sidebar-siswa`, `alert`)
- `resources/views/auth/`    : Halaman login
- `resources/views/admin/`   : View panel admin
- `resources/views/guru/`    : View panel guru
- `resources/views/siswa/`   : View panel siswa
