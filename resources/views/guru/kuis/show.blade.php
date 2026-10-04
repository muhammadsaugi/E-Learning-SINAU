@extends('layouts.app')

@section('title', 'SINAU — Detail Kuis: ' . $kuis->judul)

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar Guru -->
    @include('partials.sidebar-guru')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto" style="background: #EDE5D8;">
        <div class="max-w-3xl mx-auto px-7 py-7">

            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs text-[#8B6340] mb-4">
                <a href="{{ route('kuis.index') }}" class="hover:underline">Bank Soal & Kuis</a>
                <span>/</span>
                <span class="text-[#241508] font-semibold">Detail Kuis</span>
            </div>

            <!-- Card Header Detail Kuis -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0] mb-6" style="background:#FAF8F4;">
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div>
                        <h1 class="font-display text-xl text-[#FAF8F4]">{{ $kuis->judul }}</h1>
                        <p class="text-xs text-[#D4C0A0] mt-1">
                            Kelas: {{ $kuis->kelas->nama_kelas ?? '-' }} &bull; Durasi: {{ $kuis->durasi_menit }} menit &bull; Passing Grade (KKM): {{ $kuis->passing_grade }}
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('kuis.edit', $kuis->id) }}" class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors" style="background:#EDE5D8; color:#4A2E1A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit Kuis
                        </a>
                        <a href="{{ route('kuis.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                            &larr; Kembali
                        </a>
                    </div>
                </div>

                <!-- Daftar Soal -->
                <div class="p-6">
                    <h2 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider mb-4 flex items-center justify-between">
                        <span>Daftar Butir Soal ({{ $kuis->soal->count() }})</span>
                    </h2>

                    @if($kuis->soal->count() > 0)
                        <div class="space-y-3">
                            @foreach($kuis->soal as $idx => $s)
                                <div class="p-4 rounded-xl border border-[#E6D9C6]" style="background:#FFF;">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <span class="text-xs font-bold text-[#8B6340]">Soal #{{ $idx + 1 }}</span>
                                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded" style="background:#EDE5D8; color:#4A2E1A;">
                                                    {{ $s->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Esai' }}
                                                </span>
                                            </div>
                                            <p class="text-xs font-medium text-[#241508]">{{ $s->pertanyaan }}</p>

                                            @if($s->tipe === 'pilihan_ganda')
                                                <div class="grid grid-cols-2 gap-2 mt-2.5 text-xs text-[#6E4A2E]">
                                                    <p><strong class="text-[#241508]">A.</strong> {{ $s->opsi_a }}</p>
                                                    <p><strong class="text-[#241508]">B.</strong> {{ $s->opsi_b }}</p>
                                                    @if($s->opsi_c)<p><strong class="text-[#241508]">C.</strong> {{ $s->opsi_c }}</p>@endif
                                                    @if($s->opsi_d)<p><strong class="text-[#241508]">D.</strong> {{ $s->opsi_d }}</p>@endif
                                                </div>
                                                <p class="text-xs font-semibold text-green-700 mt-2">Kunci: Opsi {{ strtoupper($s->kunci_jawaban) }}</p>
                                            @else
                                                <p class="text-xs text-[#8B6340] italic mt-2">Pedoman Jawaban: {{ $s->kunci_jawaban }}</p>
                                            @endif
                                        </div>
                                        <form action="{{ route('guru.soal.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-[#8B6340] italic py-2">Belum ada butir soal pada kuis ini.</p>
                    @endif
                </div>
            </div>

            <!-- Form Tambah Soal Baru untuk Kuis Ini -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <div class="px-6 py-4 border-b border-[#E6D9C6]" style="background:#F3EDE2;">
                    <h3 class="font-semibold text-xs text-[#4A2E1A] uppercase tracking-wider">+ Tambah Butir Soal Baru</h3>
                </div>
                <form action="{{ route('guru.soal.store') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="kuis_id" value="{{ $kuis->id }}" />

                    <div>
                        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Pertanyaan <span class="text-red-500">*</span></label>
                        <textarea name="pertanyaan" rows="2" required placeholder="Tuliskan teks pertanyaan soal..." class="form-input resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Tipe Soal</label>
                            <select name="tipe" id="tipe-soal-select" onchange="toggleTipe(this.value)" class="form-input">
                                <option value="pilihan_ganda">Pilihan Ganda</option>
                                <option value="esai">Esai</option>
                            </select>
                        </div>
                        <div id="kunci-pg-box">
                            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kunci Jawaban</label>
                            <select name="kunci_jawaban" class="form-input">
                                <option value="A">Opsi A</option>
                                <option value="B">Opsi B</option>
                                <option value="C">Opsi C</option>
                                <option value="D">Opsi D</option>
                            </select>
                        </div>
                    </div>

                    <div id="opsi-pg-container" class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Opsi A *</label>
                            <input type="text" name="opsi_a" class="form-input text-xs" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Opsi B *</label>
                            <input type="text" name="opsi_b" class="form-input text-xs" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Opsi C</label>
                            <input type="text" name="opsi_c" class="form-input text-xs" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Opsi D</label>
                            <input type="text" name="opsi_d" class="form-input text-xs" />
                        </div>
                    </div>

                    <div class="flex justify-end pt-3 border-t border-[#E6D9C6]">
                        <button type="submit" class="text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                            + Simpan Soal
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

<script>
function toggleTipe(val) {
    const pgBox = document.getElementById('opsi-pg-container');
    const kunciPg = document.getElementById('kunci-pg-box');
    if (val === 'pilihan_ganda') {
        pgBox.style.display = 'grid';
        kunciPg.style.display = 'block';
    } else {
        pgBox.style.display = 'none';
        kunciPg.style.display = 'none';
    }
}
</script>
@endsection
