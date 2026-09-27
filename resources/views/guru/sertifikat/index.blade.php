<!-- ─── TAB TERBITKAN SERTIFIKAT ─── -->
<div id="tab-sertifikat" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Terbitkan Sertifikat</h2>
    <p class="text-sm text-[#7A6050] mb-5">Siswa yang memenuhi syarat: semua kuis dengan rata-rata ≥70.</p>
    <div class="space-y-3">
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold">AK</div>
                <div>
                    <p class="text-sm font-semibold text-[#2C1A0E]">Arini Kusuma</p>
                    <p class="text-xs text-[#7A6050]">Rata-rata: <span class="text-[#7A5C3A] font-bold">92</span> · 3/3 kuis selesai</p>
                </div>
            </div>
            <button onclick="this.textContent = this.textContent.trim() === '🏆 Terbitkan' ? '✓ Cabut Sertifikat' : '🏆 Terbitkan'"
                class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">
                🏆 Terbitkan
            </button>
        </div>
    </div>
</div>
