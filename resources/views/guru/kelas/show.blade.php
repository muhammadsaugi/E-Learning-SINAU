@extends('layouts.app')

@section('title', 'SINAU — Detail Kelas: ' . $kelas->nama_kelas)

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
                <span class="text-[#241508] font-semibold">Detail Kelas</span>
            </div>

            <!-- Card Detail Kelas -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div>
                        <div class="flex items-center gap-2.5">
                            <h1 class="font-display text-xl text-[#FAF8F4]">{{ $kelas->nama_kelas }}</h1>
                            <span class="text-[11px] font-mono font-bold px-2 py-0.5 rounded-md" style="background:#6E4A2E; color:#FAF8F4;">
                                {{ $kelas->kode_kelas }}
                            </span>
                        </div>
                        <p class="text-xs text-[#D4C0A0] mt-1">{{ $kelas->mata_pelajaran }} &bull; Pengampu: {{ $kelas->guru->name ?? 'Bapak Hendra Kurnia' }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('kelas.edit', $kelas->id) }}" class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors" style="background:#EDE5D8; color:#4A2E1A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit Kelas
                        </a>
                        <a href="{{ route('kelas.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Deskripsi Kelas -->
                    @if($kelas->deskripsi)
                        <div class="rounded-xl p-4 border border-[#E6D9C6]" style="background:#F3EDE2;">
                            <p class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider mb-1">Deskripsi / Jadwal Pembelajaran</p>
                            <p class="text-xs text-[#6E4A2E] leading-relaxed">{{ $kelas->deskripsi }}</p>
                        </div>
                    @endif

                    <!-- Modul Materi di Kelas Ini -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                                Modul Materi ({{ $kelas->materi->count() }})
                            </h2>
                            <a href="{{ route('materi.create') }}" class="text-[11px] font-semibold text-[#4A2E1A] hover:underline">+ Unggah Materi</a>
                        </div>
                        @if($kelas->materi->count() > 0)
                            <div class="space-y-2">
                                @foreach($kelas->materi as $m)
                                    <div class="flex items-center justify-between p-3 rounded-lg border border-[#E6D9C6]" style="background:#FFF;">
                                        <div>
                                            <p class="text-xs font-semibold text-[#241508]">{{ $m->judul }}</p>
                                            @if($m->deskripsi)<p class="text-[11px] text-[#8B6340]">{{ $m->deskripsi }}</p>@endif
                                        </div>
                                        @if($m->file_path)
                                            <a href="{{ route('materi.download', $m->id) }}" class="text-xs font-semibold px-2.5 py-1 rounded" style="background:#EDE5D8; color:#4A2E1A;">
                                                Unduh File
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-[#8B6340] italic py-2">Belum ada modul materi di kelas ini.</p>
                        @endif
                    </div>

                    <!-- Kuis & Evaluasi di Kelas Ini -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                Kuis & Evaluasi ({{ $kelas->kuis->count() }})
                            </h2>
                            <a href="{{ route('kuis.create') }}" class="text-[11px] font-semibold text-[#4A2E1A] hover:underline">+ Buat Kuis</a>
                        </div>
                        @if($kelas->kuis->count() > 0)
                            <div class="space-y-2">
                                @foreach($kelas->kuis as $q)
                                    <div class="flex items-center justify-between p-3 rounded-lg border border-[#E6D9C6]" style="background:#FFF;">
                                        <div>
                                            <p class="text-xs font-semibold text-[#241508]">{{ $q->judul }}</p>
                                            <p class="text-[11px] text-[#8B6340]">Durasi: {{ $q->durasi_menit }} menit &bull; KKM: {{ $q->passing_grade }} &bull; {{ $q->soal->count() }} butir soal</p>
                                        </div>
                                        <a href="{{ route('kuis.show', $q->id) }}" class="text-xs font-semibold px-2.5 py-1 rounded" style="background:#EDE5D8; color:#4A2E1A;">
                                            Lihat Soal
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-[#8B6340] italic py-2">Belum ada kuis di kelas ini.</p>
                        @endif
                    </div>
                </div>

                <!-- Footer Card -->
                <div class="px-6 py-4 border-t border-[#E6D9C6] flex justify-end">
                    <a href="{{ route('kelas.index') }}" class="text-xs font-semibold px-4 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                        Kembali ke Kelola Kelas
                    </a>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection
