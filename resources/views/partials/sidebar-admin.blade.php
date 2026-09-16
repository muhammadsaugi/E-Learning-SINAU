<!-- Sidebar Admin (Partial) -->
<aside class="w-56 shrink-0 bg-[#2C1A0E] flex flex-col min-h-full">
    <div class="px-6 py-6 border-b border-[#3D2314]">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-[#7A5C3A] flex items-center justify-center">
                <span class="text-[#FAF7F2] font-serif font-bold text-sm">S</span>
            </div>
            <div>
                <p class="font-serif font-semibold text-[#FAF7F2] text-base">SINAU</p>
                <p class="text-[9px] text-[#C4A882]">Panel Admin</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-5 space-y-0.5">
        <p class="text-[9px] font-semibold uppercase tracking-widest text-[#7A6050] px-3 mb-3">Manajemen</p>
        <button onclick="showTab('aktivitas')" id="anav-aktivitas" class="nav-active w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs font-medium text-left transition-all">
            ⊞ Pantau Aktivitas
        </button>
        <button onclick="showTab('kelas')" id="anav-kelas" class="text-[#C4A882] hover:bg-[#3D2314] w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs font-medium text-left transition-all">
            🏫 Kelola Kelas
        </button>
        <button onclick="showTab('akun')" id="anav-akun" class="text-[#C4A882] hover:bg-[#3D2314] w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs font-medium text-left transition-all">
            👥 Akun Guru & Siswa
        </button>
    </nav>

    <div class="px-3 pb-5">
        <a href="/" class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs font-medium text-[#C4A882] hover:bg-[#3D2314] transition-colors block">
            ← Keluar
        </a>
        <div class="flex items-center gap-2.5 px-3 pt-4 mt-2 border-t border-[#3D2314]">
            <div class="w-8 h-8 rounded-full bg-[#7A5C3A] flex items-center justify-center text-[#FAF7F2] text-xs font-bold">
                AD
            </div>
            <div>
                <p class="text-xs font-semibold text-[#FAF7F2]">Administrator</p>
                <p class="text-[9px] text-[#C4A882]">Super Admin</p>
            </div>
        </div>
    </div>
</aside>
