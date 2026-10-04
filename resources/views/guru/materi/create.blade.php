@extends('layouts.app')

@section('title', 'SINAU — Unggah Materi Baru')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar Guru -->
    @include('partials.sidebar-guru')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto" style="background: #EDE5D8;">
        <div class="max-w-3xl mx-auto px-7 py-7">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs text-[#8B6340] mb-4">
                <a href="{{ route('materi.index') }}" class="hover:underline">Unggah Materi</a>
                <span>/</span>
                <span class="text-[#241508] font-semibold">Unggah Materi Baru</span>
            </div>

            <!-- Card Form Tambah Materi -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-[#FAF8F4]" style="background:#6E4A2E;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-display text-lg text-[#FAF8F4]">Unggah Materi Pembelajaran Baru</h1>
                            <p class="text-xs text-[#D4C0A0] mt-0.5">Unggah berkas modul atau dokumen materi untuk siswa.</p>
                        </div>
                    </div>
                    <a href="{{ route('materi.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Body -->
                <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                Judul Materi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" value="{{ old('judul') }}" required
                                placeholder="cth: Modul 1 — Konsep Dasar Turunan Aljabar"
                                class="form-input @error('judul') border-red-400 @enderror" />
                            @error('judul')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                Kelas Tujuan <span class="text-red-500">*</span>
                            </label>
                            <select name="kelas_id" required class="form-input @error('kelas_id') border-red-400 @enderror">
                                <option value="">— Pilih Kelas —</option>
                                @if(isset($kelasList))
                                    @foreach($kelasList as $k)
                                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }} ({{ $k->mata_pelajaran }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kelas_id')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                            Deskripsi / Catatan Pembelajaran <span class="text-[#8B6340] font-normal">(opsional)</span>
                        </label>
                        <textarea name="deskripsi" rows="3" placeholder="cth: Silakan pelajari bab 1 s.d 3 sebelum mengikuti pertemuan kuis minggu depan"
                            class="form-input resize-none">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                            Berkas Modul / Materi <span class="text-[#8B6340] font-normal">(PDF, DOC, DOCX, PPT, PPTX, ZIP &bull; Maks 20MB)</span>
                        </label>
                        <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
                            class="form-input text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#4A2E1A] file:text-[#FAF8F4] hover:file:bg-[#241508] cursor-pointer" />
                        @error('file_materi')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#E6D9C6]">
                        <a href="{{ route('materi.index') }}" class="text-xs font-medium px-4 py-2.5 rounded-lg transition-colors" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">
                            Batal
                        </a>
                        <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors cursor-pointer" style="background:#4A2E1A; color:#FAF8F4;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                            Unggah Materi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection
