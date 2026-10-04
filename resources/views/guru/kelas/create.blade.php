@extends('layouts.app')

@section('title', 'SINAU — Tambah Kelas Baru')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar Guru -->
    @include('partials.sidebar-guru')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto" style="background: #EDE5D8;">
        <div class="max-w-3xl mx-auto px-7 py-7">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs text-[#8B6340] mb-4">
                <a href="{{ route('kelas.index') }}" class="hover:underline">Kelola Kelas</a>
                <span>/</span>
                <span class="text-[#241508] font-semibold">Tambah Kelas Baru</span>
            </div>

            <!-- Card Form Tambah Kelas -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-[#FAF8F4]" style="background:#6E4A2E;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-display text-lg text-[#FAF8F4]">Tambah Kelas Baru</h1>
                            <p class="text-xs text-[#D4C0A0] mt-0.5">Isi rincian kelas pembelajaran yang akan Anda ampu.</p>
                        </div>
                    </div>
                    <a href="{{ route('kelas.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Body -->
                <form action="{{ route('kelas.store') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required
                            placeholder="cth: XII IPA 4 — Matematika Peminatan"
                            class="form-input @error('nama_kelas') border-red-400 @enderror" />
                        @error('nama_kelas')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                            Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <select name="mata_pelajaran" required class="form-input @error('mata_pelajaran') border-red-400 @enderror">
                            <option value="">— Pilih Mata Pelajaran —</option>
                            @foreach(['Matematika','Biologi','Fisika','Kimia','Bahasa Indonesia','Bahasa Inggris','Sejarah','Geografi','Ekonomi','Sosiologi','Informatika','Seni Budaya','PJOK','PPKn','Prakarya','Bahasa Asing'] as $mp)
                                <option value="{{ $mp }}" {{ old('mata_pelajaran') == $mp ? 'selected' : '' }}>
                                    {{ $mp }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                            Deskripsi / Jadwal <span class="text-[#8B6340] font-normal">(opsional)</span>
                        </label>
                        <textarea name="deskripsi" rows="3" placeholder="cth: Setiap Senin & Kamis pukul 08.00–09.30 WIB di Lab Komputer"
                            class="form-input resize-none">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#E6D9C6]">
                        <a href="{{ route('kelas.index') }}" class="text-xs font-medium px-4 py-2.5 rounded-lg transition-colors" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">
                            Batal
                        </a>
                        <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors cursor-pointer" style="background:#4A2E1A; color:#FAF8F4;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection
