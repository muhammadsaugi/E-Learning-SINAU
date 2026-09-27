<!-- ─── TAB KURSUS / DASHBOARD SISWA ─── -->
<div id="tab-dashboard" class="tab-content active">
    <div class="max-w-4xl mx-auto px-8 py-8">

        <!-- Header -->
        <div class="flex items-start justify-between mb-8">
            <div>
                <p class="text-sm text-[#7A6050] mb-1">Selamat datang,</p>
                <h1 class="font-serif text-3xl font-semibold text-[#2C1A0E]">Siswa SINAU 👋</h1>
                <p class="text-sm text-[#7A6050] mt-1">Berikut daftar kelas & materi yang tersedia untuk Anda pelajari.</p>
            </div>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3 text-right">
                <p class="text-xs text-[#7A6050]">Total Kelas Aktif</p>
                <p class="font-serif font-bold text-2xl text-[#7A5C3A]">{{ isset($kelasList) ? $kelasList->count() : 0 }}</p>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                <p class="text-xs text-[#7A6050] mb-1">Kelas Tersedia</p>
                <p class="font-serif text-2xl font-semibold text-[#2C1A0E]">{{ isset($kelasList) ? $kelasList->count() : 0 }}</p>
                <p class="text-xs text-[#A67C52]">dari para guru</p>
            </div>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                <p class="text-xs text-[#7A6050] mb-1">Total Modul Materi</p>
                <p class="font-serif text-2xl font-semibold text-[#2C1A0E]">{{ isset($materiList) ? $materiList->count() : 0 }}</p>
                <p class="text-xs text-[#A67C52]">siap dipelajari</p>
            </div>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                <p class="text-xs text-[#7A6050] mb-1">Kuis & Ujian</p>
                <p class="font-serif text-2xl font-semibold text-[#2C1A0E]">{{ isset($kuisList) ? $kuisList->count() : 0 }}</p>
                <p class="text-xs text-[#A67C52]">tersedia</p>
            </div>
        </div>

        <!-- Daftar Kursus / Kelas Dinamis -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-serif text-xl font-semibold text-[#2C1A0E]">Daftar Kelas yang Diikuti</h2>
        </div>

        <div class="space-y-3 mb-8">
            @if(isset($kelasList) && $kelasList->count() > 0)
                @foreach($kelasList as $kelas)
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 hover:border-[#C4A882] hover:shadow-sm transition-all">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-[10px] font-semibold px-2.5 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Kode: {{ $kelas->kode_kelas }}</span>
                                    <span class="text-xs font-semibold text-[#5A3E28]">{{ $kelas->mata_pelajaran }}</span>
                                </div>
                                <h3 class="font-semibold text-[#2C1A0E] text-base">{{ $kelas->nama_kelas }}</h3>
                                <p class="text-xs text-[#7A6050] mt-0.5">Pengajar: {{ $kelas->guru->name ?? 'Guru SINAU' }}</p>
                                @if($kelas->deskripsi)
                                    <p class="text-xs text-[#A67C52] mt-1 italic">📝 {{ $kelas->deskripsi }}</p>
                                @endif
                            </div>
                            <div class="ml-4 text-right shrink-0">
                                <span class="text-xs font-semibold px-2.5 py-1 bg-[#D4C5A9] text-[#2C1A0E] rounded-lg">
                                    {{ $kelas->materi->count() }} Materi · {{ $kelas->kuis->count() }} Kuis
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 pt-2 border-t border-[#D4C5A9]/50">
                            <button onclick="showTab('materi')" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3.5 py-1.5 rounded-lg hover:bg-[#5A3E28] transition-colors">
                                📖 Buka Materi
                            </button>
                            <button onclick="showTab('quiz')" class="text-xs font-semibold border border-[#7A5C3A] text-[#7A5C3A] px-3.5 py-1.5 rounded-lg hover:bg-[#D4C5A9] transition-colors">
                                ✎ Lihat Kuis
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-8 text-center text-xs text-[#7A6050] italic">
                    Belum ada kelas yang dibuat oleh guru.
                </div>
            @endif
        </div>

    </div>
</div>
