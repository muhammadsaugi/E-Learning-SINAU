@extends('layouts.app')

@section('title', 'SINAU — Detail Materi: ' . $materi->judul)

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
                <span class="text-[#241508] font-semibold">Detail Materi</span>
            </div>

            <!-- Card Detail Materi -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div>
                        <h1 class="font-display text-xl text-[#FAF8F4]">{{ $materi->judul }}</h1>
                        <p class="text-xs text-[#D4C0A0] mt-1">Kelas: {{ $materi->kelas->nama_kelas ?? 'Umum' }} &bull; {{ $materi->kelas->mata_pelajaran ?? '-' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('materi.edit', $materi->id) }}" class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors" style="background:#EDE5D8; color:#4A2E1A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit Materi
                        </a>
                        <a href="{{ route('materi.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Deskripsi Materi -->
                    <div>
                        <p class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider mb-2">Deskripsi / Catatan Materi</p>
                        <div class="rounded-xl p-4 border border-[#E6D9C6]" style="background:#F3EDE2;">
                            <p class="text-xs text-[#6E4A2E] leading-relaxed">
                                {{ $materi->deskripsi ?? 'Tidak ada catatan khusus untuk modul ini.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Lampiran File -->
                    <div>
                        <p class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider mb-2">Berkas Lampiran</p>
                        @if($materi->file_path)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-[#D4C0A0]" style="background:#EDE5D8;">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background:#4A2E1A; color:#FAF8F4;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-[#241508]">{{ basename($materi->file_path) }}</p>
                                        <p class="text-[11px] text-[#8B6340]">Format: {{ strtoupper(pathinfo($materi->file_path, PATHINFO_EXTENSION)) }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('materi.download', $materi->id) }}" class="flex items-center gap-1.5 text-xs font-semibold px-4 py-2 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    Unduh Berkas
                                </a>
                            </div>
                        @else
                            <p class="text-xs text-[#8B6340] italic">Tidak ada berkas yang dilampirkan pada materi ini.</p>
                        @endif
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="px-6 py-4 border-t border-[#E6D9C6] flex justify-end">
                    <a href="{{ route('materi.index') }}" class="text-xs font-semibold px-4 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                        Kembali ke Daftar Materi
                    </a>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
