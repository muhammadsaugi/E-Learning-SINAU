<!-- ─── TAB AKTIVITAS ADMIN ─── -->
<div id="tab-aktivitas" class="tab-content">
    <div class="mb-7">
        <p class="text-[11px] font-semibold uppercase tracking-widest text-[#8B6340] mb-1">Panel Admin</p>
        <h1 class="font-display text-2xl text-[#241508]">Pantau Aktivitas</h1>
        <p class="text-sm text-[#6E4A2E] mt-0.5">Kondisi platform SINAU hari ini.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
        <!-- Card 1: Dark -->
        <div class="rounded-xl px-4 py-4" style="background:#4A2E1A; color:#FAF8F4;">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[11px] font-medium opacity-70">Total Siswa</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <p class="font-display text-3xl">69</p>
            <p class="text-[10px] opacity-60 mt-0.5">terdaftar aktif</p>
        </div>

        <!-- Card 2: Medium -->
        <div class="rounded-xl px-4 py-4" style="background:#F3EDE2; border:1px solid #D4C0A0;">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[11px] font-medium text-[#8B6340]">Total Guru</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <p class="font-display text-3xl text-[#241508]">4</p>
            <p class="text-[10px] text-[#A87C52] mt-0.5">pengajar aktif</p>
        </div>

        <!-- Card 3: Medium -->
        <div class="rounded-xl px-4 py-4" style="background:#F3EDE2; border:1px solid #D4C0A0;">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[11px] font-medium text-[#8B6340]">Kelas Aktif</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
            </div>
            <p class="font-display text-3xl text-[#241508]">6</p>
            <p class="text-[10px] text-[#A87C52] mt-0.5">berjalan</p>
        </div>

        <!-- Card 4: Accent medium -->
        <div class="rounded-xl px-4 py-4" style="background:#6E4A2E; color:#FAF8F4;">
            <div class="flex items-center justify-between mb-2">
                <p class="text-[11px] font-medium opacity-70">Kuis Selesai</p>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 opacity-40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <p class="font-display text-3xl">412</p>
            <p class="text-[10px] opacity-60 mt-0.5">pengerjaan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Aktivitas Terbaru -->
        <div>
            <h2 class="text-sm font-semibold text-[#241508] mb-3">Aktivitas Terbaru</h2>
            <div class="rounded-xl overflow-hidden" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                @php
                $activities = [
                    ['icon' => 'check', 'text' => 'Citra Maharani menyelesaikan kuis Integral Tentu (nilai 95)', 'time' => '5 mnt lalu'],
                    ['icon' => 'upload', 'text' => 'Pak Hendra mengunggah materi: Modul Substitusi Trigonometri', 'time' => '1 jam lalu'],
                    ['icon' => 'award', 'text' => '3 siswa berhak mendapat sertifikat Biologi: Sistem Reproduksi', 'time' => '2 jam lalu'],
                    ['icon' => 'edit', 'text' => 'Bu Sari memperbarui bank soal Kimia: Ikatan Kimia', 'time' => '5 jam lalu'],
                    ['icon' => 'user', 'text' => '12 siswa baru mendaftar ke kelas XII IPA 2', 'time' => '1 hari lalu'],
                ];
                @endphp
                @foreach($activities as $i => $act)
                    <div class="flex items-start gap-3 px-4 py-3 {{ $i < count($activities)-1 ? 'border-b' : '' }}" style="{{ $i < count($activities)-1 ? 'border-color:#D4C0A0;' : '' }}">
                        <div class="w-6 h-6 rounded-lg flex items-center justify-center shrink-0 mt-0.5" style="background:#EDE5D8;">
                            @if($act['icon'] === 'check')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" style="color:#4A2E1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            @elseif($act['icon'] === 'upload')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" style="color:#4A2E1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            @elseif($act['icon'] === 'award')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" style="color:#4A2E1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                            @elseif($act['icon'] === 'edit')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" style="color:#4A2E1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" style="color:#4A2E1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            @endif
                        </div>
                        <p class="text-[11px] text-[#4A2E1A] flex-1 leading-relaxed">{{ $act['text'] }}</p>
                        <span class="text-[10px] text-[#8B6340] shrink-0 whitespace-nowrap">{{ $act['time'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Distribusi Nilai -->
        <div>
            <h2 class="text-sm font-semibold text-[#241508] mb-3">Distribusi Nilai</h2>
            <div class="rounded-xl p-5" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                @php
                $dist = [
                    ['label' => 'A  85–100', 'pct' => 55, 'count' => 38, 'color' => '#4A2E1A'],
                    ['label' => 'B  70–84',  'pct' => 28, 'count' => 19, 'color' => '#8B6340'],
                    ['label' => 'C  55–69',  'pct' => 12, 'count' => 8,  'color' => '#A87C52'],
                    ['label' => 'D  < 55',   'pct' => 6,  'count' => 4,  'color' => '#D4C0A0'],
                ];
                @endphp
                <div class="space-y-3 mb-5">
                    @foreach($dist as $d)
                        <div class="flex items-center gap-3">
                            <span class="text-[11px] font-mono text-[#6E4A2E] w-20 shrink-0">{{ $d['label'] }}</span>
                            <div class="flex-1 progress-bar">
                                <div class="progress-fill" style="width:{{ $d['pct'] }}%; background:{{ $d['color'] }};"></div>
                            </div>
                            <span class="text-xs font-semibold text-[#241508] w-5 text-right">{{ $d['count'] }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="pt-4 flex gap-2" style="border-top:1px solid #D4C0A0;">
                    <button onclick="exportCSV()" class="flex items-center gap-1.5 text-xs font-semibold px-3.5 py-1.5 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Excel
                    </button>
                    <button onclick="window.print()" class="flex items-center gap-1.5 text-xs font-semibold px-3.5 py-1.5 rounded-lg transition-colors" style="background:#EDE5D8; border:1px solid #D4C0A0; color:#4A2E1A;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/>
                        </svg>
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function exportCSV() {
    const data = [['Grade','Jumlah'],['A (85-100)',38],['B (70-84)',19],['C (55-69)',8],['D (<55)',4]];
    const csv = data.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv'});
    const a = document.createElement('a'); a.href = URL.createObjectURL(blob);
    a.download = 'distribusi_nilai.csv'; a.click();
}
</script>
