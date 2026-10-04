<!-- ─── TAB UNGGAH MATERI ─── -->
<div id="tab-materi" class="tab-content">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Materi Pembelajaran</h1>
            <p class="text-sm text-[#6E4A2E] mt-0.5">Kelola modul, bahan ajar, dan dokumen untuk siswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <!-- Search Input -->
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-materi-input" placeholder="Cari materi..." class="rounded-lg pl-9 pr-3 py-2 text-xs text-[#241508] placeholder-[#8B6340] focus:outline-none w-44" style="background:#F3EDE2; border:1px solid #D4C0A0;" />
            </div>
            <!-- Tombol Unggah Materi (Resource route: materi.create) -->
            <a href="{{ route('materi.create') }}" class="flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg transition-colors cursor-pointer" style="background:#4A2E1A; color:#FAF8F4;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Unggah Materi
            </a>
        </div>
    </div>

    <!-- Daftar Materi -->
    <div class="space-y-2.5" id="materi-list-container">
        @if(isset($materiList) && $materiList->count() > 0)
            @foreach($materiList as $mat)
                <div class="materi-item-card rounded-xl px-5 py-4 transition-all"
                    style="background:#F3EDE2; border:1px solid #D4C0A0;"
                    data-judul="{{ strtolower($mat->judul) }}"
                    data-kelas="{{ strtolower($mat->kelas->nama_kelas ?? '') }}"
                    data-deskripsi="{{ strtolower($mat->deskripsi ?? '') }}">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-sm text-[#241508]">{{ $mat->judul }}</h3>
                                <span class="text-[10px] font-medium px-2 py-0.5 rounded-full" style="background:#EDE5D8; color:#4A2E1A; border:1px solid #D4C0A0;">
                                    {{ $mat->kelas->nama_kelas ?? 'Semua Kelas' }}
                                </span>
                            </div>
                            <p class="text-xs text-[#8B6340] line-clamp-1 mb-2">{{ $mat->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                            <div class="flex items-center gap-4 text-[11px] text-[#A87C52]">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $mat->created_at->format('d M Y') }}
                                </span>
                                @if($mat->file_path)
                                    <span class="flex items-center gap-1 font-mono text-[10px]" style="color:#6E4A2E;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        {{ strtoupper(pathinfo($mat->file_path, PATHINFO_EXTENSION)) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 shrink-0">
                            @if($mat->file_path)
                                <a href="{{ route('materi.download', $mat->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    Unduh
                                </a>
                            @endif
                            <!-- Resource route: materi.show -->
                            <a href="{{ route('materi.show', $mat->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                Detail
                            </a>
                            <!-- Resource route: materi.edit -->
                            <a href="{{ route('materi.edit', $mat->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg transition-colors cursor-pointer" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <!-- Resource route: materi.destroy -->
                            <form action="{{ route('materi.destroy', $mat->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
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
                </div>
            @endforeach
        @else
            <div class="rounded-xl px-6 py-12 text-center" style="background:#F3EDE2; border:2px dashed #D4C0A0;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3" style="color:#C4A882;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                </svg>
                <p class="text-sm font-semibold text-[#4A2E1A] mb-1">Belum ada materi</p>
                <p class="text-xs text-[#8B6340] mb-4">Unggah modul pembelajaran pertama untuk siswa Anda.</p>
                <a href="{{ route('materi.create') }}" class="inline-flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">
                    + Unggah Materi Sekarang
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.getElementById('search-materi-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.materi-item-card').forEach(card => {
        const match = ['data-judul','data-kelas','data-deskripsi'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
