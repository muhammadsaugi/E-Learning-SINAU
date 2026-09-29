<!-- ─── TAB LOG SERTIFIKAT ADMIN ─── -->
<div id="tab-sertifikat" class="tab-content">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Log Sertifikat</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Semua sertifikat yang telah diterbitkan oleh guru.</p>
        </div>
        <button onclick="exportCSV()" class="flex items-center gap-2 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2 rounded-lg hover:bg-[#241508] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Unduh Laporan
        </button>
    </div>

    <div class="bg-white border border-[#E6D9C6] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
            <span class="col-span-3 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Siswa</span>
            <span class="col-span-4 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Kursus</span>
            <span class="col-span-3 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Kode Verifikasi</span>
            <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-right">Status</span>
        </div>

        <div class="grid grid-cols-12 px-5 py-3.5 items-center border-b border-[#FAF8F4] hover:bg-[#FAF8F4] transition-colors last:border-0">
            <span class="col-span-3 text-sm font-medium text-[#241508]">Kelompok 8</span>
            <span class="col-span-4 text-[11px] text-[#8B6340]">Biologi: Sistem Reproduksi</span>
            <div class="col-span-3 flex justify-center">
                <span class="text-[10px] font-mono font-semibold px-2.5 py-1 rounded-lg bg-[#F3EDE2] text-[#6E4A2E] border border-[#D4C0A0]">SNU-BIO-001</span>
            </div>
            <div class="col-span-2 flex justify-end">
                <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#e8f5e9] text-[#2e7d32] border border-[#a5d6a7]">Valid</span>
            </div>
        </div>
    </div>
</div>
