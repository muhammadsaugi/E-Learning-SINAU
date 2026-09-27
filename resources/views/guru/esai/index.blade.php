<!-- ─── TAB NILAI ESAI ─── -->
<div id="tab-esai" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Nilai Ujian Esai</h2>
    <p class="text-sm text-[#7A6050] mb-5">Berikan nilai untuk jawaban esai yang dikumpulkan siswa.</p>
    <div class="space-y-3">
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-3 flex-1">
                    <div class="w-8 h-8 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold shrink-0 mt-0.5">AK</div>
                    <div>
                        <p class="text-sm font-semibold text-[#2C1A0E]">Arini Kusuma</p>
                        <p class="text-xs text-[#7A6050] mb-1">Matematika · Dikumpulkan 10 Jan 2025</p>
                        <p class="text-xs text-[#3D2314] italic">"Analisis Penerapan Integral dalam Kehidupan Nyata"</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <input type="number" min="0" max="100" placeholder="0–100"
                        onkeydown="if(event.key==='Enter') simpanNilai(this)"
                        class="w-20 bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-1.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52] text-center" />
                    <button onclick="simpanNilai(this.previousElementSibling)"
                        class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg hover:bg-[#5A3E28] transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
