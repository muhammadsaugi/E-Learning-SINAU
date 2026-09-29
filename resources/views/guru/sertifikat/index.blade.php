<!-- ─── TAB SERTIFIKAT ─── -->
<div id="tab-sertifikat" class="tab-content">
    <div class="mb-6">
        <h1 class="font-display text-2xl text-[#241508]">Terbitkan Sertifikat</h1>
        <p class="text-sm text-[#8B6340] mt-0.5">Siswa yang memenuhi syarat: semua kuis diselesaikan dengan rata-rata ≥ 70.</p>
    </div>
    <div class="space-y-3">
        @php
        $siswaBersertifikat = [
            ['init' => 'AK', 'nama' => 'Arini Kusuma', 'skor' => 92, 'kuis' => '3/3'],
            ['init' => 'CM', 'nama' => 'Citra Maharani', 'skor' => 88, 'kuis' => '3/3'],
        ];
        @endphp
        @foreach($siswaBersertifikat as $s)
            <div class="data-card bg-white border border-[#E6D9C6] rounded-xl px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] text-xs font-semibold">{{ $s['init'] }}</div>
                    <div>
                        <div class="flex items-center gap-2 mb-0.5">
                            <p class="text-sm font-semibold text-[#241508]">{{ $s['nama'] }}</p>
                            <span class="badge-grade badge-a">Lulus</span>
                        </div>
                        <p class="text-[11px] text-[#A87C52]">
                            Rata-rata: <span class="text-[#4A2E1A] font-bold">{{ $s['skor'] }}</span>
                            · {{ $s['kuis'] }} kuis selesai
                        </p>
                    </div>
                </div>
                <button onclick="toggleSertifikat(this)" data-issued="0"
                    class="flex items-center gap-2 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
                    </svg>
                    Terbitkan
                </button>
            </div>
        @endforeach
    </div>
</div>

<script>
function toggleSertifikat(btn) {
    const isIssued = btn.dataset.issued === '1';
    const icon = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>`;
    if (isIssued) {
        btn.innerHTML = icon + ' Terbitkan';
        btn.className = 'flex items-center gap-2 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2 rounded-lg hover:bg-[#241508] transition-colors';
        btn.dataset.issued = '0';
    } else {
        btn.innerHTML = icon + ' Cabut';
        btn.className = 'flex items-center gap-2 text-xs font-semibold bg-red-100 text-red-700 border border-red-200 px-4 py-2 rounded-lg hover:bg-red-200 transition-colors';
        btn.dataset.issued = '1';
    }
}
</script>
