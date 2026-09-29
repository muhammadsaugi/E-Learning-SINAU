<!-- ─── TAB IZIN PEMBAHASAN ─── -->
<div id="tab-izin" class="tab-content">
    <div class="mb-6">
        <h1 class="font-display text-2xl text-[#241508]">Izin Pembahasan</h1>
        <p class="text-sm text-[#8B6340] mt-0.5">Aktifkan untuk membolehkan siswa melihat jawaban yang benar.</p>
    </div>
    <div class="bg-white border border-[#E6D9C6] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
            <span class="col-span-6 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Kuis</span>
            <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Peserta</span>
            <span class="col-span-4 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-right">Izin Pembahasan</span>
        </div>

        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#FAF8F4]">
            <div class="col-span-6">
                <p class="text-sm font-medium text-[#241508]">Kuis: Integral Tentu</p>
                <p class="text-[11px] text-[#A87C52] mt-0.5">Matematika · 12 Jan 2025</p>
            </div>
            <div class="col-span-2 text-center text-sm font-medium text-[#241508]">8</div>
            <div class="col-span-4 flex items-center justify-end gap-2.5">
                <span class="text-xs font-medium text-[#A87C52]" id="label-q1">Tutup</span>
                <button onclick="togglePermission('q1', this)" class="relative w-11 h-6 rounded-full bg-[#E6D9C6] transition-colors duration-200 shrink-0">
                    <span class="absolute top-0.5 translate-x-0.5 w-5 h-5 rounded-full bg-white shadow-sm transition-all duration-200"></span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12 px-5 py-4 items-center">
            <div class="col-span-6">
                <p class="text-sm font-medium text-[#241508]">Kuis: Sistem Reproduksi</p>
                <p class="text-[11px] text-[#A87C52] mt-0.5">Biologi · 5 Jan 2025</p>
            </div>
            <div class="col-span-2 text-center text-sm font-medium text-[#241508]">8</div>
            <div class="col-span-4 flex items-center justify-end gap-2.5">
                <span class="text-xs font-medium text-green-700" id="label-q2">Buka</span>
                <button onclick="togglePermission('q2', this)" class="relative w-11 h-6 rounded-full bg-[#4A2E1A] transition-colors duration-200 shrink-0">
                    <span class="absolute top-0.5 translate-x-5 w-5 h-5 rounded-full bg-white shadow-sm transition-all duration-200"></span>
                </button>
            </div>
        </div>
    </div>
</div>
