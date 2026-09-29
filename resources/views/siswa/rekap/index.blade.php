<!-- ─── TAB REKAP NILAI SISWA ─── -->
<div id="tab-nilai" class="tab-content">
    <div class="max-w-3xl mx-auto px-7 py-7">
        <div class="mb-7">
            <h1 class="font-display text-2xl text-[#241508]">Rekap Nilai</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Ringkasan hasil evaluasi dan kuis Anda.</p>
        </div>

        @php
            $totalMengerjakan = isset($nilaiList) ? $nilaiList->count() : 0;
            $avgNilai = $totalMengerjakan > 0 ? round($nilaiList->avg('nilai')) : 0;
            $kuisLulus = isset($nilaiList) ? $nilaiList->where('status', 'lulus')->count() : 0;
            $totalKuisTersedia = isset($kuisList) ? $kuisList->count() : 0;
            $maxNilai = $totalMengerjakan > 0 ? $nilaiList->max('nilai') : 0;
        @endphp

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-3 mb-8">
            <div class="bg-[#4A2E1A] rounded-xl px-4 py-5 text-[#FAF8F4]">
                <p class="text-[11px] text-[#A87C52] font-medium mb-2">Rata-rata Nilai</p>
                <p class="font-display text-4xl">{{ $avgNilai }}</p>
                <p class="text-[10px] text-[#A87C52] mt-1">dari 100 poin</p>
            </div>
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-5">
                <p class="text-[11px] text-[#8B6340] font-medium mb-2">Kuis Lulus</p>
                <p class="font-display text-4xl text-[#241508]">{{ $kuisLulus }}</p>
                <p class="text-[10px] text-[#A87C52] mt-1">dari {{ $totalKuisTersedia }} tersedia</p>
            </div>
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-5">
                <p class="text-[11px] text-[#8B6340] font-medium mb-2">Nilai Tertinggi</p>
                <p class="font-display text-4xl text-[#241508]">{{ $maxNilai }}</p>
                <p class="text-[10px] text-[#A87C52] mt-1">poin terbaik</p>
            </div>
        </div>

        <!-- Detail Tabel -->
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-sm font-semibold text-[#241508]">Detail Nilai Kuis</h2>
            <span class="text-[11px] text-[#A87C52]">{{ $totalMengerjakan }} kuis diselesaikan</span>
        </div>

        <div class="bg-white border border-[#E6D9C6] rounded-xl overflow-hidden">
            <div class="grid grid-cols-12 px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
                <span class="col-span-4 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Kuis</span>
                <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Tanggal</span>
                <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Nilai</span>
                <span class="col-span-1 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Grade</span>
                <span class="col-span-3 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-right">Status</span>
            </div>

            @if(isset($nilaiList) && $nilaiList->count() > 0)
                @foreach($nilaiList as $item)
                    <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#FAF8F4] last:border-0 hover:bg-[#FAF8F4] transition-colors">
                        <div class="col-span-4">
                            <p class="text-sm font-semibold text-[#241508]">{{ $item->kuis->judul ?? 'Kuis' }}</p>
                            <p class="text-[11px] text-[#A87C52]">{{ $item->kuis->kelas->mata_pelajaran ?? '' }}</p>
                        </div>
                        <span class="col-span-2 text-[11px] text-[#A87C52]">
                            {{ $item->updated_at ? $item->updated_at->format('d M Y') : '-' }}
                        </span>
                        <div class="col-span-2 flex items-center justify-center gap-1">
                            <span class="text-sm font-bold {{ $item->status === 'lulus' ? 'text-[#241508]' : 'text-red-700' }}">{{ $item->nilai }}</span>
                        </div>
                        <div class="col-span-1 flex justify-center">
                            @php $g = $item->grade ?? '-'; @endphp
                            <span class="badge-grade {{ $g === 'A' ? 'badge-a' : ($g === 'B' ? 'badge-b' : ($g === 'C' ? 'badge-c' : 'badge-d')) }}">{{ $g }}</span>
                        </div>
                        <div class="col-span-3 flex justify-end">
                            @if($item->status === 'lulus')
                                <span class="pill-lulus text-[10px] font-semibold px-2.5 py-0.5 rounded-full">Lulus</span>
                            @else
                                <span class="pill-gagal text-[10px] font-semibold px-2.5 py-0.5 rounded-full">Di Bawah KKM</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="px-5 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A] mb-1">Belum ada nilai</p>
                    <p class="text-xs text-[#8B6340] mb-4">Kerjakan kuis untuk mulai melihat rekap nilai di sini.</p>
                    <button onclick="showTab('quiz')" class="inline-flex items-center gap-1.5 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-5 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                        Ke Halaman Kuis
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

    </div>
</div>
