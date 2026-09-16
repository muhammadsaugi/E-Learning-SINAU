# Panduan Edit Tampilan SINAU (Tailwind CSS)

Dokumen ini untuk membantu kamu (atau temanmu) mengubah tampilan — warna,
posisi elemen, ukuran, jarak — pada project SINAU **setelah** dikonversi ke
Laravel Blade + Tailwind CSS. Tidak perlu paham Tailwind secara mendalam,
cukup ikuti pola di bawah.

Prinsip dasar Tailwind: **tidak ada file CSS yang diedit langsung**. Semua
tampilan diatur lewat "class" pendek yang ditulis di file `.blade.php`,
langsung menempel di tag HTML-nya. Jadi kalau mau ubah tampilan sesuatu,
cari elemen HTML-nya di file Blade, lalu ubah/tambah class di situ.

---

## 1. Cara Mengubah Warna

### 1.1 Kalau warnanya sudah didaftarkan sebagai token (disarankan)
Setelah konversi dari prompt Antigravity, warna utama SINAU sudah didaftarkan
di `tailwind.config.js`, contoh:

```js
colors: {
  'sinau-cream': '#FAF6EF',
  'sinau-green': '#1F3D2E',
  'sinau-terracotta': '#D97B4F',
}
```

Kalau kamu mau **mengubah warna hijau tua SINAU di SELURUH halaman sekaligus**
(misal jadi biru navy), cukup ubah satu baris ini:

```js
'sinau-green': '#1F3D2E',   // ganti hex-nya, contoh: '#1E3A5F'
```

Lalu jalankan ulang:
```
npm run dev
```
Semua tombol/teks/background yang pakai `bg-sinau-green`, `text-sinau-green`,
dsb. otomatis berubah warnanya — tidak perlu cari satu-satu di tiap file.

### 1.2 Kalau mau ubah warna di SATU elemen saja
Cari elemen di file Blade-nya, lihat class yang berawalan:
- `bg-...` → warna latar belakang
- `text-...` → warna teks
- `border-...` → warna garis tepi

Contoh, tombol seperti ini:
```html
<button class="bg-sinau-terracotta text-white px-4 py-2 rounded">
  Simpan
</button>
```
Kalau mau tombol ini saja jadi hijau (bukan ikut token global), ganti:
```html
<button class="bg-sinau-green text-white px-4 py-2 rounded">
```
Atau pakai warna bawaan Tailwind langsung tanpa token, misal `bg-red-600`,
`bg-blue-500`, `bg-emerald-700` (Tailwind sudah punya banyak warna siap
pakai, tinggal ketik nama warnanya + tingkat kegelapan 50–900).

---

## 2. Cara Menggeser / Memindahkan Posisi Elemen (mis. Tombol)

Tailwind mengatur posisi lewat kombinasi class **flexbox** atau **grid**,
bukan drag-and-drop seperti Figma. Beberapa pola paling sering dipakai:

### 2.1 Menggeser ke kanan/kiri dalam satu baris
Kalau tombol berada dalam container yang punya class `flex`, gunakan:
- `justify-start` → rata kiri
- `justify-center` → rata tengah
- `justify-end` → rata kanan
- `justify-between` → elemen menyebar dengan jarak sama di antaranya

Contoh — memindahkan tombol dari kiri ke kanan:
```html
<!-- sebelum: tombol di kiri -->
<div class="flex justify-start">
  <button>Simpan</button>
</div>

<!-- sesudah: tombol di kanan -->
<div class="flex justify-end">
  <button>Simpan</button>
</div>
```

### 2.2 Mengatur jarak antar elemen (margin/padding)
- `p-4` → padding (jarak ke dalam) di semua sisi, angka makin besar makin
  lebar jaraknya (`p-2`, `p-4`, `p-6`, `p-8`, dst — kelipatan 4px)
- `m-4` → margin (jarak ke luar) di semua sisi
- `mt-4`, `mb-4`, `ml-4`, `mr-4` → margin hanya atas/bawah/kiri/kanan
- `gap-4` → jarak antar elemen di dalam `flex` atau `grid`

Contoh — menambah jarak tombol dari elemen di atasnya:
```html
<button class="mt-6">Simpan</button>
```
Angka `6` bisa dibesarkan (`mt-8`, `mt-10`) untuk jarak lebih jauh, atau
dikecilkan (`mt-2`) untuk jarak lebih rapat.

### 2.3 Menggeser posisi bebas (di luar alur normal halaman)
Kalau elemen perlu ditempel di posisi spesifik (misalnya pojok kanan atas
sebuah kartu), biasanya dipakai kombinasi ini pada elemen induk & elemen
yang digeser:
```html
<div class="relative">
  <button class="absolute top-2 right-2">×</button>
</div>
```
- `relative` di elemen induk = jadi acuan posisi
- `absolute` di elemen anak = keluar dari alur normal, mengambang
- `top-2`, `right-2`, `bottom-2`, `left-2` = jarak dari tepi elemen induk

---

## 3. Cara Mengubah Ukuran

- Ukuran teks: `text-sm` (kecil) → `text-base` → `text-lg` → `text-xl` →
  `text-2xl` → `text-3xl` (makin besar)
- Ketebalan teks: `font-normal`, `font-medium`, `font-semibold`, `font-bold`
- Lebar elemen: `w-full` (selebar container), `w-1/2` (setengah), `w-64`
  (lebar tetap ~256px)
- Tinggi elemen: sama polanya dengan `h-...`
- Sudut membulat: `rounded` (sedikit), `rounded-lg`, `rounded-xl`,
  `rounded-full` (bulat penuh, cocok untuk avatar/badge)

---

## 4. Cara Kerja Praktis Sehari-hari

1. Buka file Blade halaman yang mau diubah, misalnya
   `resources/views/guru/dashboard.blade.php`.
2. Cari teks/elemen yang mau diubah tampilannya (pakai Ctrl+F, cari
   kata-kata yang muncul di layar, misalnya "Unggah Materi").
3. Lihat class Tailwind yang menempel di tag tersebut, ubah sesuai
   kebutuhan memakai daftar di atas.
4. Simpan file, lalu pastikan `npm run dev` masih berjalan di terminal
   (kalau belum jalan, jalankan dulu) — halaman akan otomatis refresh
   menampilkan perubahan.
5. Kalau warnanya terasa "kurang pas" dan kamu tidak yakin nama warnanya,
   bisa cari referensi lengkap warna bawaan Tailwind di tailwindcss.com
   bagian dokumentasi warna, atau tinggal coba-coba ganti angka tingkat
   kegelapannya (400/500/600/700) dulu sebelum ganti nama warna.

---

## 5. Kalau Bingung Class Mana yang Harus Diubah

Cara termudah tanpa harus hafal nama class:
1. Buka halaman di browser lewat `php artisan serve` / `npm run dev`.
2. Klik kanan elemen yang mau diubah → "Inspect" / "Inspeksi".
3. Di panel DevTools, lihat atribut `class="..."` pada elemen tersebut —
   itu daftar class Tailwind yang aktif di elemen itu.
4. Cocokkan nama classnya ke file Blade yang sesuai, lalu edit di sana.
