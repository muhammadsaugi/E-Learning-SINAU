<!-- ─── TAB MONITORING KELAS ADMIN ─── -->
<div id="tab-kelas" class="tab-content">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Monitoring Daftar Kelas</h1>
            <p class="text-sm text-[#7A6050]">Pantau status dan aktivitas kelas yang berjalan.</p>
        </div>
    </div>

    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
            <span class="col-span-5 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kelas</span>
            <span class="col-span-3 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Mata Pelajaran</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Status</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Aksi</span>
        </div>

        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
            <div class="col-span-5">
                <p class="text-sm font-medium text-[#2C1A0E]">Matematika 10A</p>
                <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Kode: MTH10A</span>
            </div>
            <span class="col-span-3 text-xs text-[#7A6050]">Matematika</span>
            <span class="col-span-2 text-center text-xs font-bold text-[#7A5C3A]">Aktif</span>
            <div class="col-span-2 flex justify-end">
                <button onclick="arsipKelas(this)" class="text-xs text-[#7A5C3A] hover:underline">Detail</button>
            </div>
        </div>

        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
            <div class="col-span-5">
                <p class="text-sm font-medium text-[#2C1A0E]">Kelas 11 IPA 2</p>
                <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Kode: BIO11B</span>
            </div>
            <span class="col-span-3 text-xs text-[#7A6050]">Biologi</span>
            <span class="col-span-2 text-center text-xs font-bold text-[#7A5C3A]">Aktif</span>
            <div class="col-span-2 flex justify-end">
                <button onclick="arsipKelas(this)" class="text-xs text-[#7A5C3A] hover:underline">Detail</button>
            </div>
        </div>
    </div>
</div>
