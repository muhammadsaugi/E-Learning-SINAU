@extends('layouts.app')

@section('title', 'SINAU — Edit Materi: ' . $materi->judul)

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
                <span class="text-[#241508] font-semibold">Edit Materi</span>
            </div>

            <!-- Card Form Edit Materi -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#6E4A2E;">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-[#FAF8F4]" style="background:#4A2E1A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-display text-lg text-[#FAF8F4]">Edit Materi: {{ $materi->judul }}</h1>
                            <p class="text-xs text-[#D4C0A0] mt-0.5">Perbarui rincian modul atau ganti file materi lampiran.</p>
                        </div>
                    </div>
                    <a href="{{ route('materi.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Body -->
                <form action="{{ route('materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                Judul Materi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}" required
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
                                @if(isset($kelasList))
                                    @foreach($kelasList as $k)
                                        <option value="{{ $k->id }}" {{ old('kelas_id', $materi->kelas_id) == $k->id ? 'selected' : '' }}>
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
                            Deskripsi / Catatan Pembelajaran
                        </label>
                        <textarea name="deskripsi" rows="3"
                            class="form-input resize-none">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-xs font-semibold text-[#4A2E1A]">
                                Ganti Berkas <span class="text-[#8B6340] font-normal">(opsional — biarkan kosong jika tidak ingin mengganti)</span>
                            </label>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-semibold bg-amber-100 text-amber-900 border border-amber-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-amber-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                Maksimal 8 MB
                            </span>
                        </div>

                        <!-- Info Banner Ukuran Berkas -->
                        <div class="p-3 rounded-xl border border-amber-200 bg-amber-50/80 text-xs text-amber-950 mb-2.5 flex items-start gap-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-700 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <div class="space-y-0.5">
                                <p class="font-bold text-amber-900">Perhatian Batas Ukuran File:</p>
                                <p class="text-[11px] text-amber-800 leading-relaxed">
                                    Ukuran berkas pengganti maksimal adalah <span class="font-semibold text-amber-950 underline decoration-amber-400">8 MB</span>. File yang lebih besar dari 8 MB akan otomatis ditolak untuk mencegah error server (<em>PostTooLargeException</em>). Format didukung: PDF, DOC, DOCX, PPT, PPTX, ZIP.
                                </p>
                            </div>
                        </div>

                        @if($materi->file_path)
                            <p class="text-xs text-[#6E4A2E] mb-2 flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                                File aktif: <span class="font-mono text-[11px]">{{ basename($materi->file_path) }}</span>
                                <a href="{{ route('materi.download', $materi->id) }}" class="underline text-[#4A2E1A] font-semibold ml-1">Unduh</a>
                            </p>
                        @endif

                        <input type="file" id="file_materi_input_edit" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
                            class="form-input text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#4A2E1A] file:text-[#FAF8F4] hover:file:bg-[#241508] cursor-pointer" />

                        <!-- JS Client-side Warning Message -->
                        <div id="file_size_error_edit" class="hidden mt-2 p-2.5 rounded-lg bg-red-50 border border-red-300 text-xs text-red-700 items-start gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            <span id="file_size_error_text_edit"></span>
                        </div>

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
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('file_materi_input_edit');
        const errorContainer = document.getElementById('file_size_error_edit');
        const errorText = document.getElementById('file_size_error_text_edit');
        const maxSizeBytes = 8 * 1024 * 1024; // 8 MB

        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > maxSizeBytes) {
                        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                        errorText.innerHTML = `<strong>Ukuran file terlalu besar (${fileSizeMB} MB)!</strong> Batas maksimal adalah <strong>8 MB</strong>. Berkas telah di-reset, silakan kompres atau pilih berkas yang lebih kecil.`;
                        errorContainer.classList.remove('hidden');
                        errorContainer.classList.add('flex');
                        e.target.value = ''; // Reset input agar tidak terkirim
                    } else {
                        errorContainer.classList.add('hidden');
                        errorContainer.classList.remove('flex');
                    }
                }
            });
        }
    });
</script>
@endsection
