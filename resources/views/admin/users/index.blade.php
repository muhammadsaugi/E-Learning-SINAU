<!-- ─── TAB KELOLA AKUN GURU & SISWA ─── -->
<div id="tab-akun" class="tab-content">
    <div class="flex items-center justify-between mb-5">
        <div>
            <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Kelola Akun Guru & Siswa</h1>
            <p class="text-sm text-[#7A6050]">Tambah, pantau, atau kelola akun pengguna platform.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="openModal('guru')" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors">+ Tambah Guru</button>
            <button onclick="openModal('siswa')" class="text-xs font-semibold bg-[#C4A882] text-[#2C1A0E] px-4 py-2.5 rounded-xl hover:bg-[#B8956E] transition-colors">+ Tambah Siswa</button>
        </div>
    </div>

    <!-- Daftar Guru -->
    <h2 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Daftar Guru</h2>
    <div id="guru-list" class="space-y-2 mb-7">
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold">HK</div>
                <div>
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-[#2C1A0E]">Bapak Hendra Kurnia</p>
                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Aktif</span>
                    </div>
                    <p class="text-xs text-[#7A6050]">guru@sinau.test · Guru Pengajar</p>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="hapusRow(this)" class="text-[10px] text-red-700 hover:text-red-900 border border-red-300 px-2 py-1 rounded">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Daftar Siswa -->
    <h2 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Daftar Siswa</h2>
    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Nama</span>
            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Email</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Status</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Aksi</span>
        </div>
        <div id="siswa-list">
            <div class="grid grid-cols-12 px-5 py-3 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
                <div class="col-span-4 flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[9px] font-semibold shrink-0">K8</div>
                    <p class="text-sm text-[#2C1A0E]">Kelompok 8</p>
                </div>
                <span class="col-span-4 text-xs text-[#7A6050]">siswa@sinau.test</span>
                <span class="col-span-2 text-center text-xs font-bold text-[#7A5C3A]">Aktif</span>
                <div class="col-span-2 flex justify-end">
                    <button onclick="hapusRow(this)" class="text-[10px] text-red-700 hover:text-red-900 border border-red-300 px-2 py-1 rounded">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</div>
