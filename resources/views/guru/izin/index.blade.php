<!-- ─── TAB IZIN PEMBAHASAN ─── -->
<div id="tab-izin" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Izin Pembahasan Jawaban</h2>
    <p class="text-sm text-[#7A6050] mb-5">Aktifkan untuk membolehkan siswa melihat jawaban benar/salah.</p>
    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
            <span class="col-span-6 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kuis</span>
            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Peserta</span>
            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Izin</span>
        </div>
        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9]">
            <div class="col-span-6">
                <p class="text-sm font-medium text-[#2C1A0E]">Quiz: Integral Tentu</p>
                <p class="text-xs text-[#7A6050]">Matematika · 12 Jan 2025</p>
            </div>
            <div class="col-span-2 text-center text-sm text-[#2C1A0E]">8</div>
            <div class="col-span-4 flex items-center justify-end gap-3">
                <span class="text-xs font-medium text-[#A67C52]" id="label-q1">✗ Tutup</span>
                <button onclick="togglePermission('q1', this)" class="relative w-11 h-6 rounded-full bg-[#D4C5A9] transition-colors duration-200 shrink-0">
                    <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow transition-all duration-200"></span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9]">
            <div class="col-span-6">
                <p class="text-sm font-medium text-[#2C1A0E]">Quiz: Sistem Reproduksi</p>
                <p class="text-xs text-[#7A6050]">Biologi · 5 Jan 2025</p>
            </div>
            <div class="col-span-2 text-center text-sm text-[#2C1A0E]">8</div>
            <div class="col-span-4 flex items-center justify-end gap-3">
                <span class="text-xs font-medium text-[#7A5C3A]" id="label-q2">✓ Buka</span>
                <button onclick="togglePermission('q2', this)" class="relative w-11 h-6 rounded-full bg-[#7A5C3A] transition-colors duration-200 shrink-0">
                    <span class="absolute top-0.5 left-5 w-5 h-5 rounded-full bg-white shadow transition-all duration-200"></span>
                </button>
            </div>
        </div>
    </div>
</div>
