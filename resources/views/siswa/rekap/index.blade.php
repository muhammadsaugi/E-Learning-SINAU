<!-- ─── TAB REKAP NILAI SISWA ─── -->
<div id="tab-nilai" class="tab-content">
    <div class="max-w-3xl mx-auto px-8 py-8">
        <div class="mb-8">
            <h1 class="font-serif text-3xl font-semibold text-[#2C1A0E]">Rekap Nilai</h1>
            <p class="text-sm text-[#7A6050] mt-1">Ringkasan hasil evaluasi dan kuis kamu.</p>
        </div>

        @php
            $totalMengerjakan = isset($nilaiList) ? $nilaiList->count() : 0;
            $avgNilai = $totalMengerjakan > 0 ? round($nilaiList->avg('nilai')) : 0;
            $kuisLulus = isset($nilaiList) ? $nilaiList->where('status', 'lulus')->count() : 0;
            $totalKuisTersedia = isset($kuisList) ? $kuisList->count() : 0;
            $maxNilai = $totalMengerjakan > 0 ? $nilaiList->max('nilai') : 0;
        @endphp

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-[#7A5C3A] rounded-xl px-5 py-5 text-[#FAF7F2]">
                <p class="text-xs text-[#C4A882] mb-1">Rata-rata Nilai</p>
                <p class="font-serif text-4xl font-bold">{{ $avgNilai }}</p>
                <p class="text-xs text-[#C4A882] mt-0.5">dari 100 poin</p>
            </div>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-5">
                <p class="text-xs text-[#7A6050] mb-1">Kuis Lulus</p>
                <p class="font-serif text-4xl font-bold text-[#2C1A0E]">{{ $kuisLulus }}</p>
                <p class="text-xs text-[#A67C52] mt-0.5">dari {{ $totalKuisTersedia }} kuis tersedia</p>
            </div>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-5">
                <p class="text-xs text-[#7A6050] mb-1">Nilai Tertinggi</p>
                <p class="font-serif text-4xl font-bold text-[#2C1A0E]">{{ $maxNilai }}</p>
                <p class="text-xs text-[#A67C52] mt-0.5">poin terbaik</p>
            </div>
        </div>

        <!-- Tabel Nilai -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-serif text-xl font-semibold text-[#2C1A0E]">Detail Nilai Kuis</h2>
            <span class="text-xs text-[#7A6050]">{{ $totalMengerjakan }} kuis telah diselesaikan</span>
        </div>

        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden shadow-sm">
            <div class="grid grid-cols-12 px-5 py-3 border-b border-[#D4C5A9] bg-[#D4C5A9]/50">
                <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kuis & Pelajaran</span>
                <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Tanggal</span>
                <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Nilai</span>
                <span class="col-span-1 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Grade</span>
                <span class="col-span-3 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Status</span>
            </div>

            @if(isset($nilaiList) && $nilaiList->count() > 0)
                @foreach($nilaiList as $item)
                    <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9]/70 last:border-b-0 hover:bg-[#D4C5A9]/20 transition-colors">
                        <div class="col-span-4">
                            <p class="text-sm font-semibold text-[#2C1A0E]">{{ $item->kuis->judul ?? 'Kuis Ujian' }}</p>
                            <p class="text-xs text-[#7A6050]">
                                {{ $item->kuis->kelas->nama_kelas ?? 'Umum' }} · {{ $item->kuis->kelas->mata_pelajaran ?? 'Mata Pelajaran' }}
                            </p>
                        </div>
                        <span class="col-span-2 text-xs text-[#7A6050]">
                            {{ $item->updated_at ? $item->updated_at->format('d M Y, H:i') : '-' }}
                        </span>
                        <div class="col-span-2 flex items-center justify-center gap-1.5">
                            <span class="text-base font-bold {{ $item->status === 'lulus' ? 'text-[#2C1A0E]' : 'text-red-700' }}">
                                {{ $item->nilai }}
                            </span>
                            <span class="text-[10px] text-[#7A6050]">/ 100</span>
                        </div>
                        <div class="col-span-1 flex justify-center">
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md 
                                @if(in_array($item->grade, ['A', 'B'])) bg-[#7A5C3A]/15 text-[#7A5C3A] 
                                @elseif($item->grade === 'C') bg-[#C4A882]/40 text-[#5A3E28]
                                @else bg-red-100 text-red-700 @endif">
                                {{ $item->grade ?? '-' }}
                            </span>
                        </div>
                        <div class="col-span-3 flex justify-end">
                            @if($item->status === 'lulus')
                                <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-green-100 text-green-800 border border-green-200">
                                    ✓ Lulus
                                </span>
                            @else
                                <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full bg-red-100 text-red-700 border border-red-200">
                                    ✗ Di Bawah KKM
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="px-5 py-10 text-center">
                    <p class="text-sm font-medium text-[#2C1A0E] mb-1">Belum ada hasil kuis</p>
                    <p class="text-xs text-[#7A6050] mb-4">Kamu belum mengerjakan kuis evaluasi apapun. Mulai kerjakan kuis untuk melihat nilai kamu di sini.</p>
                    <button onclick="showTab('quiz')" class="inline-block text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-xl hover:bg-[#5A3E28] transition-colors shadow-sm">
                        Ke Halaman Evaluasi Kuis →
                    </button>
                </div>
            @endif
        </div>

    </div>
</div>
