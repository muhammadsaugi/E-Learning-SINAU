<!-- Sidebar Siswa (Partial) -->
<aside class="w-64 shrink-0 bg-[#EDE5D8] border-r border-[#D4C5A9] flex flex-col">
    <!-- Logo -->
    <div class="px-7 py-7 border-b border-[#D4C5A9]">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-[#7A5C3A] flex items-center justify-center">
                <span class="text-[#FAF7F2] font-serif font-bold text-sm">S</span>
            </div>
            <div>
                <span class="font-serif font-semibold text-[#2C1A0E] text-lg tracking-wide">SINAU</span>
                <p class="text-[10px] text-[#7A6050] -mt-0.5">Platform Belajar Siswa</p>
            </div>
        </div>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        <p class="text-[10px] font-semibold uppercase tracking-widest text-[#A67C52] px-3 mb-3">Menu Utama</p>
        <button onclick="showTab('dashboard')" id="nav-dashboard" class="nav-item nav-active w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all text-left">
            <span class="text-base w-5 text-center">⊞</span> Dashboard
        </button>
        <button onclick="showTab('materi')" id="nav-materi" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all text-left text-[#5A3E28]">
            <span class="text-base w-5 text-center">📄</span> Materi Kursus
        </button>
        <button onclick="showTab('quiz')" id="nav-quiz" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all text-left text-[#5A3E28]">
            <span class="text-base w-5 text-center">✎</span> Evaluasi Kuis
        </button>
        <button onclick="showTab('nilai')" id="nav-nilai" class="nav-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all text-left text-[#5A3E28]">
            <span class="text-base w-5 text-center">★</span> Nilai
        </button>
    </nav>

    <!-- User -->
    <div class="px-4 py-5 border-t border-[#D4C5A9]">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] font-semibold text-sm">
                K8
            </div>
            <div>
                <p class="text-sm font-semibold text-[#2C1A0E]">Kelompok 8</p>
                <p class="text-xs text-[#7A6050]">Kelas XII IPA 2</p>
            </div>
        </div>
    </div>
</aside>
