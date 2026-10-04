<!-- Sidebar Guru -->
<aside class="w-56 shrink-0 flex flex-col min-h-screen" style="background:#241508; border-right:1px solid #3D2211;">
    <!-- Brand -->
    <div class="px-5 py-5 border-b border-[#3D2211]">
        <a href="{{ url('/guru') }}" class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background:#6E4A2E;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div>
                <p class="font-display text-[#FAF8F4] text-sm leading-tight">SINAU</p>
                <p class="text-[#8B6340] text-[10px]">Mode Guru</p>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-[#8B6340] px-3 mb-2">Manajemen</p>

        <!-- Kelola Kelas -->
        <a href="{{ url('/guru#kelas') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('kelas'); return false; }"
           id="gnav-kelas"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all {{ request()->is('kelas*') ? 'nav-active' : 'text-[#C4A882]' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Kelola Kelas
        </a>

        <!-- Unggah Materi -->
        <a href="{{ url('/guru#materi') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('materi'); return false; }"
           id="gnav-materi"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all {{ request()->is('materi*') ? 'nav-active' : 'text-[#C4A882]' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            Unggah Materi
        </a>

        <!-- Bank Soal & Kuis -->
        <a href="{{ url('/guru#banksoal') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('banksoal'); return false; }"
           id="gnav-banksoal"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all {{ request()->is('kuis*') ? 'nav-active' : 'text-[#C4A882]' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
            </svg>
            Bank Soal & Kuis
        </a>

        <!-- Rekap Nilai -->
        <a href="{{ url('/guru#nilai') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('nilai'); return false; }"
           id="gnav-nilai"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all {{ (request()->is('guru') && !request()->is('kelas*') && !request()->is('materi*') && !request()->is('kuis*')) ? 'nav-active' : 'text-[#C4A882]' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            Rekap Nilai
        </a>

        <!-- Nilai Esai -->
        <a href="{{ url('/guru#esai') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('esai'); return false; }"
           id="gnav-esai"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all text-[#C4A882]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/>
            </svg>
            Nilai Esai
        </a>

        <!-- Izin Pembahasan -->
        <a href="{{ url('/guru#izin') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('izin'); return false; }"
           id="gnav-izin"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all text-[#C4A882]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            Izin Pembahasan
        </a>

        <!-- Sertifikat -->
        <a href="{{ url('/guru#sertifikat') }}"
           onclick="if(typeof showTab === 'function' && window.location.pathname === '/guru'){ showTab('sertifikat'); return false; }"
           id="gnav-sertifikat"
           class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all text-[#C4A882]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
            </svg>
            Sertifikat
        </a>
    </nav>

    <!-- User footer -->
    <div class="px-3 pb-5 pt-3 border-t border-[#3D2211]">
        <div class="flex items-center gap-2.5 px-2 mb-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-[#FAF8F4] text-xs font-bold shrink-0" style="background:#4A2E1A; border:1px solid #6E4A2E;">
                {{ strtoupper(substr(Auth::user()->name ?? 'HK', 0, 2)) }}
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-[#FAF8F4] truncate">{{ Auth::user()->name ?? 'Bapak Hendra Kurnia' }}</p>
                <p class="text-[10px] text-[#8B6340]">Guru Pengampu</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-xs font-medium text-[#C4A882] hover:text-[#FAF8F4] hover:bg-[#3D2211] transition-colors cursor-pointer border border-[#3D2211]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
