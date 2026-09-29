<!-- ─── TAB BERANDA SISWA ─── -->
<div id="tab-dashboard" class="tab-content active">
    <div class="max-w-3xl mx-auto px-7 py-7">

        <!-- Header -->
        <div class="mb-7">
            <p class="text-[11px] font-semibold uppercase tracking-widest text-[#A87C52] mb-1">Beranda Siswa</p>
            <h1 class="font-display text-2xl text-[#241508]">Selamat datang, {{ Auth::user()->name ?? 'Siswa' }}</h1>
            <p class="text-sm text-[#8B6340] mt-1">Berikut daftar kelas & materi yang tersedia untuk Anda.</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-3 mb-8">
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                <p class="text-[11px] text-[#8B6340] font-medium mb-2">Kelas Aktif</p>
                <p class="font-display text-2xl text-[#241508]">{{ isset($kelasList) ? $kelasList->count() : 0 }}</p>
                <p class="text-[10px] text-[#A87C52] mt-0.5">dari guru</p>
            </div>
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                <p class="text-[11px] text-[#8B6340] font-medium mb-2">Modul Materi</p>
                <p class="font-display text-2xl text-[#241508]">{{ isset($materiList) ? $materiList->count() : 0 }}</p>
                <p class="text-[10px] text-[#A87C52] mt-0.5">siap dipelajari</p>
            </div>
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                <p class="text-[11px] text-[#8B6340] font-medium mb-2">Kuis & Ujian</p>
                <p class="font-display text-2xl text-[#241508]">{{ isset($kuisList) ? $kuisList->count() : 0 }}</p>
                <p class="text-[10px] text-[#A87C52] mt-0.5">tersedia</p>
            </div>
        </div>

        <!-- Daftar Kelas -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold text-[#241508]">Kelas yang Diikuti</h2>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="siswa-search-kelas" placeholder="Cari kelas..."
                    class="bg-[#FAF8F4] border border-[#E6D9C6] rounded-lg pl-9 pr-3 py-1.5 text-xs text-[#241508] placeholder-[#A87C52] focus:outline-none focus:border-[#8B6340] w-44" />
            </div>
        </div>

        <div class="space-y-3" id="siswa-kelas-container">
            @if(isset($kelasList) && $kelasList->count() > 0)
                @foreach($kelasList as $kelas)
                    <div class="data-card siswa-kelas-card bg-white border border-[#E6D9C6] rounded-xl p-5"
                        data-nama="{{ strtolower($kelas->nama_kelas) }}"
                        data-mapel="{{ strtolower($kelas->mata_pelajaran) }}"
                        data-kode="{{ strtolower($kelas->kode_kelas) }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <span class="text-[10px] font-mono font-semibold px-2 py-0.5 rounded-md bg-[#F3EDE2] text-[#6E4A2E] border border-[#D4C0A0]">{{ $kelas->kode_kelas }}</span>
                                    <span class="text-[11px] font-medium text-[#8B6340]">{{ $kelas->mata_pelajaran }}</span>
                                </div>
                                <h3 class="font-semibold text-[#241508] text-sm">{{ $kelas->nama_kelas }}</h3>
                                <p class="text-[11px] text-[#A87C52] mt-0.5 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    {{ $kelas->guru->name ?? 'Guru SINAU' }}
                                </p>
                                @if($kelas->deskripsi)
                                    <p class="text-[11px] text-[#8B6340] mt-1 italic">{{ $kelas->deskripsi }}</p>
                                @endif
                            </div>
                            <div class="ml-4 shrink-0 text-right">
                                <p class="text-[11px] font-medium text-[#4A2E1A]">{{ $kelas->materi->count() }} materi</p>
                                <p class="text-[11px] text-[#8B6340]">{{ $kelas->kuis->count() }} kuis</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 pt-3 border-t border-[#F3EDE2]">
                            <button onclick="showTab('materi')" class="flex items-center gap-1.5 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                </svg>
                                Buka Materi
                            </button>
                            <button onclick="showTab('quiz')" class="flex items-center gap-1.5 text-xs font-semibold border border-[#D4C0A0] text-[#4A2E1A] px-4 py-2 rounded-lg hover:bg-[#F3EDE2] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 11l3 3L22 4"/>
                                </svg>
                                Kerjakan Kuis
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-[#E6D9C6] rounded-xl px-6 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A]">Belum ada kelas</p>
                    <p class="text-xs text-[#8B6340] mt-1">Guru belum membuat kelas untuk platform ini.</p>
                </div>
            @endif
        </div>

    </div>
</div>

<script>
document.getElementById('siswa-search-kelas')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.siswa-kelas-card').forEach(card => {
        const match = ['data-nama','data-mapel','data-kode'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
