<!-- ─── TAB NILAI ESAI ─── -->
<div id="tab-esai" class="tab-content">
    <div class="mb-6">
        <h1 class="font-display text-2xl text-[#241508]">Nilai Esai</h1>
        <p class="text-sm text-[#8B6340] mt-0.5">Berikan nilai untuk jawaban esai yang dikumpulkan siswa.</p>
    </div>
    <div class="space-y-3">
        <div class="data-card bg-white border border-[#E6D9C6] rounded-xl px-5 py-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-3 flex-1 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] text-xs font-semibold shrink-0 mt-0.5">AK</div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-[#241508]">Arini Kusuma</p>
                        <p class="text-[11px] text-[#A87C52] mb-1.5">Matematika · Dikumpulkan 10 Jan 2025</p>
                        <p class="text-xs text-[#6E4A2E] italic bg-[#FAF8F4] border border-[#F3EDE2] rounded-lg px-3 py-2">
                            "Analisis Penerapan Integral dalam Kehidupan Nyata"
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <input type="number" min="0" max="100" placeholder="0–100"
                        onkeydown="if(event.key==='Enter') simpanNilai(this)"
                        class="w-20 bg-[#FAF8F4] border border-[#E6D9C6] rounded-lg px-3 py-2 text-sm text-[#241508] focus:outline-none focus:border-[#8B6340] text-center" />
                    <button onclick="simpanNilai(this.previousElementSibling)"
                        class="text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-3 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>

        <div class="data-card bg-white border border-[#E6D9C6] rounded-xl px-5 py-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-3 flex-1 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] text-xs font-semibold shrink-0 mt-0.5">BP</div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-[#241508]">Bagas Pratama</p>
                        <p class="text-[11px] text-[#A87C52] mb-1.5">Biologi · Dikumpulkan 8 Jan 2025</p>
                        <p class="text-xs text-[#6E4A2E] italic bg-[#FAF8F4] border border-[#F3EDE2] rounded-lg px-3 py-2">
                            "Peran Sistem Reproduksi dalam Keberlangsungan Makhluk Hidup"
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <input type="number" min="0" max="100" placeholder="0–100"
                        onkeydown="if(event.key==='Enter') simpanNilai(this)"
                        class="w-20 bg-[#FAF8F4] border border-[#E6D9C6] rounded-lg px-3 py-2 text-sm text-[#241508] focus:outline-none focus:border-[#8B6340] text-center" />
                    <button onclick="simpanNilai(this.previousElementSibling)"
                        class="text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-3 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
