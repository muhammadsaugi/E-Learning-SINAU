<!-- ─── TAB LOG SERTIFIKAT ADMIN ─── -->
<div id="tab-sertifikat" class="tab-content">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Log & Verifikasi Sertifikat</h1>
            <p class="text-sm text-[#7A6050]">Daftar semua sertifikat yang telah diterbitkan oleh guru.</p>
        </div>
        <button onclick="exportCSV()" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">⤓ Unduh Laporan</button>
    </div>

    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Siswa</span>
            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kursus</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Kode Verifikasi</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Status</span>
        </div>

        <div class="grid grid-cols-12 px-5 py-3.5 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
            <span class="col-span-4 text-sm font-medium text-[#2C1A0E]">Kelompok 8</span>
            <span class="col-span-4 text-xs text-[#7A6050]">Biologi: Sistem Reproduksi</span>
            <span class="col-span-2 text-center text-xs font-mono text-[#7A5C3A]">SNU-BIO-001</span>
            <div class="col-span-2 flex justify-end">
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Valid</span>
            </div>
        </div>
    </div>
</div>
