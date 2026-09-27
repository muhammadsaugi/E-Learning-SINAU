<!-- ─── TAB AKTIVITAS ADMIN ─── -->
<div id="tab-aktivitas" class="tab-content active">
    <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E] mb-1">Pantau Aktivitas Sistem</h1>
    <p class="text-sm text-[#7A6050] mb-7">Selamat datang, Administrator. Berikut kondisi platform hari ini.</p>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
            <div class="flex items-center justify-between mb-2">
                <p class="text-xs text-[#7A6050]">Total Siswa</p><span>🎓</span>
            </div>
            <p class="font-serif text-3xl font-bold text-[#2C1A0E]">69</p>
            <p class="text-[10px] text-[#A67C52] mt-0.5">terdaftar aktif</p>
        </div>
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
            <div class="flex items-center justify-between mb-2">
                <p class="text-xs text-[#7A6050]">Total Guru</p><span>👨‍🏫</span>
            </div>
            <p class="font-serif text-3xl font-bold text-[#2C1A0E]">4</p>
            <p class="text-[10px] text-[#A67C52] mt-0.5">pengajar aktif</p>
        </div>
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
            <div class="flex items-center justify-between mb-2">
                <p class="text-xs text-[#7A6050]">Kelas Aktif</p><span>🏫</span>
            </div>
            <p class="font-serif text-3xl font-bold text-[#2C1A0E]">6</p>
            <p class="text-[10px] text-[#A67C52] mt-0.5">berjalan sekarang</p>
        </div>
        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
            <div class="flex items-center justify-between mb-2">
                <p class="text-xs text-[#7A6050]">Kuis Selesai</p><span>✎</span>
            </div>
            <p class="font-serif text-3xl font-bold text-[#2C1A0E]">412</p>
            <p class="text-[10px] text-[#A67C52] mt-0.5">total pengerjaan</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Aktivitas Terbaru -->
        <div>
            <h2 class="font-serif text-lg font-semibold text-[#2C1A0E] mb-4">Aktivitas Terbaru</h2>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                    <span class="text-sm shrink-0 mt-0.5">🎓</span>
                    <p class="text-xs text-[#2C1A0E] flex-1">Citra Maharani menyelesaikan kuis Integral Tentu dengan nilai 95</p>
                    <span class="text-[10px] text-[#A67C52] shrink-0">5 mnt lalu</span>
                </div>
                <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                    <span class="text-sm shrink-0 mt-0.5">📚</span>
                    <p class="text-xs text-[#2C1A0E] flex-1">Pak Hendra mengunggah materi baru: Modul Substitusi Trigonometri</p>
                    <span class="text-[10px] text-[#A67C52] shrink-0">1 jam lalu</span>
                </div>
                <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                    <span class="text-sm shrink-0 mt-0.5">🏆</span>
                    <p class="text-xs text-[#2C1A0E] flex-1">3 siswa berhak mendapatkan sertifikat Biologi: Sistem Reproduksi</p>
                    <span class="text-[10px] text-[#A67C52] shrink-0">2 jam lalu</span>
                </div>
                <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                    <span class="text-sm shrink-0 mt-0.5">👨‍🏫</span>
                    <p class="text-xs text-[#2C1A0E] flex-1">Bu Sari memperbarui bank soal Kimia: Ikatan Kimia</p>
                    <span class="text-[10px] text-[#A67C52] shrink-0">5 jam lalu</span>
                </div>
                <div class="flex items-start gap-3 px-4 py-3">
                    <span class="text-sm shrink-0 mt-0.5">🎓</span>
                    <p class="text-xs text-[#2C1A0E] flex-1">12 siswa baru mendaftar ke kelas XII IPA 2</p>
                    <span class="text-[10px] text-[#A67C52] shrink-0">1 hari lalu</span>
                </div>
            </div>
        </div>

        <!-- Distribusi Nilai -->
        <div>
            <h2 class="font-serif text-lg font-semibold text-[#2C1A0E] mb-4">Distribusi Nilai Siswa</h2>
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5">
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-xs text-[#7A6050] w-20 shrink-0">A (85–100)</span>
                    <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:55%"></div></div>
                    <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">38</span>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-xs text-[#7A6050] w-20 shrink-0">B (70–84)</span>
                    <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:28%"></div></div>
                    <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">19</span>
                </div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-xs text-[#7A6050] w-20 shrink-0">C (55–69)</span>
                    <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:12%"></div></div>
                    <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">8</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-[#7A6050] w-20 shrink-0">D (&lt;55)</span>
                    <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:6%"></div></div>
                    <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">4</span>
                </div>
                <div class="mt-5 pt-4 border-t border-[#D4C5A9] flex gap-2">
                    <button onclick="exportCSV()" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg hover:bg-[#5A3E28] transition-colors">⤓ Excel</button>
                    <button onclick="window.print()" class="text-xs font-semibold border border-[#D4C5A9] text-[#7A5C3A] px-3 py-1.5 rounded-lg hover:bg-[#D4C5A9] transition-colors">⤓ PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>
