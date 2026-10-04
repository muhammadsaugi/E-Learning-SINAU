@extends('layouts.app')

@section('title', 'SINAU — Buat Kuis Baru')

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
                <span class="text-[#241508] font-semibold">Buat Kuis Baru</span>
            </div>

            <!-- Card Form Buat Kuis -->
            <div class="rounded-2xl shadow-xl overflow-hidden border border-[#D4C0A0]" style="background:#FAF8F4;">
                <!-- Header Card -->
                <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-[#FAF8F4]" style="background:#6E4A2E;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-display text-lg text-[#FAF8F4]">Buat Kuis & Ujian Baru</h1>
                            <p class="text-xs text-[#D4C0A0] mt-0.5">Tentukan informasi kuis, durasi, KKM, dan butir pertanyaan.</p>
                        </div>
                    </div>
                    <a href="{{ route('kuis.index') }}" class="text-xs text-[#D4C0A0] hover:text-[#FAF8F4] px-3 py-1.5 rounded-lg transition-colors" style="background:rgba(255,255,255,0.1);">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Body -->
                <form action="{{ route('kuis.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Bagian 1: Informasi Kuis -->
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold" style="background:#4A2E1A; color:#FAF8F4;">1</span>
                            <h2 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider">Informasi Umum Kuis</h2>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                    Judul Kuis / Topik Ujian <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="judul" value="{{ old('judul') }}" required
                                    placeholder="cth: Kuis 1 — Evaluasi Pemahaman Integral Tentu"
                                    class="form-input @error('judul') border-red-400 @enderror" />
                                @error('judul')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                        Kelas Tujuan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="kelas_id" required class="form-input @error('kelas_id') border-red-400 @enderror">
                                        <option value="">— Pilih Kelas —</option>
                                        @if(isset($kelasList))
                                            @foreach($kelasList as $k)
                                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kelas_id')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                        Durasi <span class="text-[#8B6340] font-normal">(menit)</span> <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 30) }}" min="5" max="180" required
                                        class="form-input @error('durasi_menit') border-red-400 @enderror" />
                                    @error('durasi_menit')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
                                        KKM / Passing Grade <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="passing_grade" value="{{ old('passing_grade', 75) }}" min="0" max="100" required
                                        class="form-input @error('passing_grade') border-red-400 @enderror" />
                                    @error('passing_grade')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian 2: Pertanyaan Pertama (Opsional) -->
                    <div class="pt-5 border-t border-[#E6D9C6]">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold" style="background:#6E4A2E; color:#FAF8F4;">2</span>
                                <h2 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider">Butir Pertanyaan Pertama <span class="text-[#8B6340] font-normal lowercase">(opsional)</span></h2>
                            </div>
                            <span class="text-[11px] text-[#8B6340]">Bisa diisi sekarang atau nanti</span>
                        </div>

                        <div class="rounded-xl p-4 border border-[#E6D9C6] space-y-4" style="background:#F3EDE2;">
                            <p class="text-xs text-[#6E4A2E]">
                                Anda dapat langsung menuliskan pertanyaan pertama di bawah ini. Setelah kuis dibuat, Anda juga dapat menambah butir-butir pertanyaan berikutnya kapan saja.
                            </p>

                            <div>
                                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1">Teks Pertanyaan</label>
                                <textarea name="pertanyaan" rows="2" placeholder="Tuliskan teks pertanyaan soal di sini..."
                                    class="form-input resize-none">{{ old('pertanyaan') }}</textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1">Tipe Soal</label>
                                    <select name="tipe" id="tipe-soal-create" onchange="toggleTipeCreate(this.value)" class="form-input text-xs">
                                        <option value="pilihan_ganda">Pilihan Ganda (Multiple Choice)</option>
                                        <option value="esai">Esai / Uraian</option>
                                    </select>
                                </div>
                                <div id="box-kunci-pg">
                                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1">Kunci Jawaban Benar</label>
                                    <select name="kunci_jawaban" class="form-input text-xs">
                                        <option value="A">Opsi A</option>
                                        <option value="B">Opsi B</option>
                                        <option value="C">Opsi C</option>
                                        <option value="D">Opsi D</option>
                                    </select>
                                </div>
                            </div>

                            <div id="box-opsi-pg" class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Pilihan Opsi A</label>
                                    <input type="text" name="opsi_a" placeholder="Jawaban A" class="form-input text-xs" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Pilihan Opsi B</label>
                                    <input type="text" name="opsi_b" placeholder="Jawaban B" class="form-input text-xs" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Pilihan Opsi C</label>
                                    <input type="text" name="opsi_c" placeholder="Jawaban C" class="form-input text-xs" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-medium text-[#6E4A2E] mb-1">Pilihan Opsi D</label>
                                    <input type="text" name="opsi_d" placeholder="Jawaban D" class="form-input text-xs" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Action Buttons -->
                    <div class="flex items-center justify-between pt-4 border-t border-[#E6D9C6]">
                        <p class="text-xs text-[#8B6340]">
                            Setelah disimpan, halaman pengelolaan seluruh soal kuis ini akan otomatis terbuka.
                        </p>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('kuis.index') }}" class="text-xs font-medium px-4 py-2.5 rounded-lg transition-colors" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">
                                Batal
                            </a>
                            <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors cursor-pointer" style="background:#4A2E1A; color:#FAF8F4;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                Simpan & Kelola Soal &rarr;
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

<script>
function toggleTipeCreate(val) {
    const boxOpsi = document.getElementById('box-opsi-pg');
    const boxKunci = document.getElementById('box-kunci-pg');
    if (val === 'pilihan_ganda') {
        boxOpsi.style.display = 'grid';
        boxKunci.style.display = 'block';
    } else {
        boxOpsi.style.display = 'none';
        boxKunci.style.display = 'none';
    }
}
</script>
@endsection
