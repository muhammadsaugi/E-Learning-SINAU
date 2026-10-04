<!-- ─── TAB BANK SOAL & KUIS ─── -->
<div id="tab-banksoal" class="tab-content">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Bank Soal & Kuis</h1>
            <p class="text-sm text-[#6E4A2E] mt-0.5">Kelola topik kuis, ujian, dan butir-butir soal</p>
        </div>
        <div class="flex items-center gap-2">
            <!-- Search -->
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-kuis-input" placeholder="Cari kuis..." class="rounded-lg pl-9 pr-3 py-2 text-xs text-[#241508] placeholder-[#8B6340] focus:outline-none w-40" style="background:#F3EDE2; border:1px solid #D4C0A0;" />
            </div>
            <!-- Tombol Buat Kuis (Resource route: kuis.create) -->
            <a href="{{ route('kuis.create') }}" class="flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg transition-colors cursor-pointer" style="background:#4A2E1A; color:#FAF8F4;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Buat Kuis
            </a>
        </div>
    </div>

    <!-- Daftar Kuis -->
    <div id="kuis-list-container" class="space-y-3">
        @if(isset($kuisList) && $kuisList->count() > 0)
            @foreach($kuisList as $itemKuis)
                <div class="kuis-item-card rounded-xl overflow-hidden"
                    style="background:#F3EDE2; border:1px solid #D4C0A0;"
                    data-judul="{{ strtolower($itemKuis->judul) }}"
                    data-kelas="{{ strtolower($itemKuis->kelas->nama_kelas ?? '') }}">

                    <!-- Header kartu -->
                    <div class="flex items-center justify-between px-5 py-4" style="border-bottom:1px solid #D4C0A0;">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-[#241508] text-sm">{{ $itemKuis->judul }}</h3>
                            <p class="text-[11px] text-[#8B6340] mt-0.5 flex items-center gap-3 flex-wrap">
                                <span class="font-medium text-[#6E4A2E]">{{ $itemKuis->kelas->nama_kelas ?? 'Umum' }}</span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    {{ $itemKuis->durasi_menit }} menit
                                </span>
                                <span>KKM {{ $itemKuis->passing_grade }}</span>
                                <span class="font-bold text-[#4A2E1A]">{{ $itemKuis->soal->count() }} soal</span>
                            </p>
                        </div>
                        <div class="flex items-center gap-1.5 ml-3 shrink-0">
                            <!-- Resource route: kuis.show (Detail & Kelola Soal) -->
                            <a href="{{ route('kuis.show', $itemKuis->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail & Soal
                            </a>
                            <!-- Resource route: kuis.edit -->
                            <a href="{{ route('kuis.edit', $itemKuis->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <!-- Resource route: kuis.destroy -->
                            <form action="{{ route('kuis.destroy', $itemKuis->id) }}" method="POST" onsubmit="return confirm('Hapus kuis beserta semua soalnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#c62828; background:#fce4ec; border:1px solid #ef9a9a;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Soal list ringkas -->
                    @if($itemKuis->soal->count() > 0)
                        <div class="px-5 py-3 space-y-2">
                            @foreach($itemKuis->soal as $idx => $soal)
                                <div class="flex items-start justify-between gap-3 py-2.5 last:pb-0" style="border-bottom:1px solid #D4C0A0;">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-[10px] font-bold text-[#8B6340]">#{{ $idx + 1 }}</span>
                                            <span class="text-[9px] font-semibold px-1.5 py-0.5 rounded-md" style="{{ $soal->tipe === 'pilihan_ganda' ? 'background:#EDE5D8; color:#4A2E1A;' : 'background:#e3f2fd; color:#1565c0;' }}">
                                                {{ $soal->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Esai' }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-[#241508]">{{ $soal->pertanyaan }}</p>
                                        @if($soal->tipe === 'pilihan_ganda')
                                            <div class="grid grid-cols-2 gap-x-4 mt-2 text-[11px] text-[#6E4A2E]">
                                                <span><span class="font-bold">A.</span> {{ $soal->opsi_a }}</span>
                                                <span><span class="font-bold">B.</span> {{ $soal->opsi_b }}</span>
                                                @if($soal->opsi_c)<span><span class="font-bold">C.</span> {{ $soal->opsi_c }}</span>@endif
                                                @if($soal->opsi_d)<span><span class="font-bold">D.</span> {{ $soal->opsi_d }}</span>@endif
                                            </div>
                                            <p class="text-[10px] font-semibold mt-1.5 text-green-700">Kunci: Opsi {{ $soal->kunci_jawaban }}</p>
                                        @else
                                            <p class="text-[10px] text-[#8B6340] italic mt-1">Pedoman: {{ $soal->kunci_jawaban }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded transition-colors" style="color:#ef9a9a;" title="Hapus soal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="px-5 py-3 flex items-center gap-2">
                            <p class="text-xs text-[#8B6340] italic">Belum ada butir soal.</p>
                            <a href="{{ route('kuis.show', $itemKuis->id) }}" class="text-xs font-semibold underline text-[#4A2E1A]">+ Tambah butir soal di halaman detail</a>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="rounded-xl px-6 py-12 text-center" style="background:#F3EDE2; border:2px dashed #D4C0A0;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3" style="color:#C4A882;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
                <p class="text-sm font-semibold text-[#4A2E1A] mb-1">Belum ada kuis</p>
                <p class="text-xs text-[#8B6340] mb-4">Buat kuis pertama dan tambahkan soal untuk siswa.</p>
                <a href="{{ route('kuis.create') }}" class="inline-flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">
                    + Buat Kuis Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('search-kuis-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.kuis-item-card').forEach(card => {
        const match = ['data-judul','data-kelas'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
