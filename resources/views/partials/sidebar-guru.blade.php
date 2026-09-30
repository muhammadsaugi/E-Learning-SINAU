<!-- Sidebar Guru -->
<aside class="w-52 shrink-0 bg-[#EDE5D8] border-r border-[#D4C0A0] flex flex-col py-4 px-2.5 overflow-y-auto">
    <!-- Brand -->
    <div class="px-3 mb-5 pb-4 border-b border-[#D4C0A0]">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-[#4A2E1A] flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                </svg>
            </div>
            <div>
                <p class="font-display text-[#241508] text-sm leading-tight">SINAU</p>
                <p class="text-[#8B6340] text-[10px]">Mode Guru</p>
            </div>
        </div>
    </div>

    <p class="text-[10px] font-semibold uppercase tracking-widest text-[#8B6340] px-3 mb-2">Manajemen</p>

    <button onclick="showTab('kelas')" id="gnav-kelas" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Kelola Kelas
    </button>

    <button onclick="showTab('materi')" id="gnav-materi" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
        </svg>
        Unggah Materi
    </button>

    <button onclick="showTab('banksoal')" id="gnav-banksoal" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
        </svg>
        Bank Soal
    </button>

    <button onclick="showTab('nilai')" id="gnav-nilai" class="nav-item nav-active w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-70 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
        </svg>
        Rekap Nilai
    </button>

    <button onclick="showTab('esai')" id="gnav-esai" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/>
        </svg>
        Nilai Esai
    </button>

    <button onclick="showTab('izin')" id="gnav-izin" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
        </svg>
        Izin Pembahasan
    </button>

    <button onclick="showTab('sertifikat')" id="gnav-sertifikat" class="nav-item w-full flex items-center gap-2.5 px-3 py-2.5 text-[13px] font-medium text-left text-[#5A3E28] mb-0.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-60 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>
        </svg>
        Sertifikat
    </button>
</aside>
