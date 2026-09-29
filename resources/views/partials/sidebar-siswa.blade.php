<!-- Sidebar Siswa -->
<aside class="w-60 shrink-0 bg-[#FAF8F4] border-r border-[#E6D9C6] flex flex-col">
    <!-- Logo -->
    <div class="px-6 py-5 border-b border-[#E6D9C6]">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-[#4A2E1A] flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div>
                <p class="font-display text-[#241508] text-base leading-tight">SINAU</p>
                <p class="text-[#A87C52] text-[10px]">Platform Belajar</p>
            </div>
        </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-3 py-4">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-[#A87C52] px-3 mb-3">Menu</p>

        <button onclick="showTab('dashboard')" id="nav-dashboard" class="nav-item nav-active w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-left text-[#4A2E1A] mb-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Beranda
        </button>

        <button onclick="showTab('materi')" id="nav-materi" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-left text-[#6E4A2E] mb-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
            </svg>
            Materi Kursus
        </button>

        <button onclick="showTab('quiz')" id="nav-quiz" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-left text-[#6E4A2E] mb-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
            </svg>
            Evaluasi Kuis
        </button>

        <button onclick="showTab('nilai')" id="nav-nilai" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-left text-[#6E4A2E] mb-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            Rekap Nilai
        </button>
    </nav>

    <!-- User footer -->
    <div class="px-4 py-4 border-t border-[#E6D9C6]">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] font-semibold text-xs shrink-0">
                {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-[#241508] truncate">{{ Auth::user()->name ?? 'Siswa' }}</p>
                <p class="text-[11px] text-[#A87C52]">Siswa</p>
            </div>
        </div>
    </div>
</aside>
