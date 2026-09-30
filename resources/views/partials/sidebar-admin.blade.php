<!-- Sidebar Admin -->
<aside class="w-56 shrink-0 flex flex-col min-h-screen" style="background:#241508; border-right:1px solid #3D2211;">
    <!-- Brand -->
    <div class="px-5 py-5 border-b border-[#3D2211]">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-[#6E4A2E] flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div>
                <p class="font-display text-[#FAF8F4] text-sm leading-tight">SINAU</p>
                <p class="text-[#8B6340] text-[10px]">Panel Admin</p>
            </div>
        </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-3 py-5 space-y-0.5">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-[#5A3E28] px-3 mb-3">Manajemen</p>

        <button onclick="showTab('aktivitas')" id="anav-aktivitas" class="nav-active w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
            </svg>
            Pantau Aktivitas
        </button>

        <button onclick="showTab('kelas')" id="anav-kelas" class="text-[#C4A882] hover:bg-[#3D2211] w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Kelola Kelas
        </button>

        <button onclick="showTab('akun')" id="anav-akun" class="text-[#C4A882] hover:bg-[#3D2211] w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            Akun Pengguna
        </button>

        <button onclick="showTab('sertifikat')" id="anav-sertifikat" class="text-[#C4A882] hover:bg-[#3D2211] w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-left transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
            </svg>
            Sertifikat
        </button>
    </nav>

    <!-- User footer -->
    <div class="px-3 pb-5">
        <a href="/" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium text-[#8B6340] hover:bg-[#3D2211] transition-colors block mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Ganti Akun
        </a>
        <div class="flex items-center gap-2.5 px-3 pt-4 mt-2 border-t border-[#3D2211]">
            <div class="w-8 h-8 rounded-full bg-[#6E4A2E] flex items-center justify-center text-[#FAF8F4] text-xs font-bold shrink-0">
                AD
            </div>
            <div>
                <p class="text-[13px] font-semibold text-[#FAF8F4]">Administrator</p>
                <p class="text-[10px] text-[#8B6340]">Super Admin</p>
            </div>
        </div>
    </div>
</aside>
