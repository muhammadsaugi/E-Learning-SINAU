<!-- ─── TAB KELOLA AKUN PENGGUNA ─── -->
<div id="tab-akun" class="tab-content">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Kelola Akun</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Tambah, pantau, dan kelola akun guru & siswa.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="openModal('guru')" class="flex items-center gap-1.5 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Guru
            </button>
            <button onclick="openModal('siswa')" class="flex items-center gap-1.5 text-xs font-semibold bg-[#F3EDE2] text-[#4A2E1A] border border-[#D4C0A0] px-4 py-2.5 rounded-lg hover:bg-[#E6D9C6] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Siswa
            </button>
        </div>
    </div>

    <!-- Daftar Guru -->
    <div class="mb-6">
        <h2 class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-3">Daftar Guru</h2>
        <div id="guru-list" class="space-y-2">
            <div class="bg-white border border-[#E6D9C6] rounded-xl px-5 py-3.5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] text-xs font-semibold">HK</div>
                    <div>
                        <div class="flex items-center gap-2 mb-0.5">
                            <p class="text-sm font-semibold text-[#241508]">Bapak Hendra Kurnia</p>
                            <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#e8f5e9] text-[#2e7d32] border border-[#a5d6a7]">Aktif</span>
                        </div>
                        <p class="text-[11px] text-[#A87C52]">guru@sinau.test</p>
                    </div>
                </div>
                <button onclick="hapusRow(this)" class="text-xs font-medium text-red-700 hover:text-red-900 border border-red-200 bg-red-50/50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa -->
    <div>
        <h2 class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-3">Daftar Siswa</h2>
        <div class="bg-white border border-[#E6D9C6] rounded-xl overflow-hidden">
            <div class="grid grid-cols-12 px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
                <span class="col-span-5 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Nama</span>
                <span class="col-span-4 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Email</span>
                <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Status</span>
                <span class="col-span-1 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-right">Aksi</span>
            </div>
            <div id="siswa-list">
                <div class="grid grid-cols-12 px-5 py-3 items-center border-b border-[#FAF8F4] hover:bg-[#FAF8F4] transition-colors last:border-0">
                    <div class="col-span-5 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] text-[9px] font-semibold shrink-0">K8</div>
                        <p class="text-sm font-medium text-[#241508]">Kelompok 8</p>
                    </div>
                    <span class="col-span-4 text-[11px] text-[#8B6340]">siswa@sinau.test</span>
                    <div class="col-span-2 flex justify-center">
                        <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#e8f5e9] text-[#2e7d32] border border-[#a5d6a7]">Aktif</span>
                    </div>
                    <div class="col-span-1 flex justify-end">
                        <button onclick="hapusRow(this)" class="text-xs font-medium text-red-600 hover:text-red-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
