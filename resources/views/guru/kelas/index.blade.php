<!-- ─── TAB KELOLA KELAS GURU ─── -->
<div id="tab-kelas" class="tab-content">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-5">
        <div>
            <h1 class="font-display text-2xl text-[#241508] leading-tight">Kelola Kelas</h1>
            <p class="text-sm text-[#6E4A2E] mt-0.5">Atur dan kelola kelas yang Anda ampu.</p>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('guru') }}" class="flex items-center gap-2">
            <input type="hidden" name="tab" value="kelas" />
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" name="q" value="{{ request('q', $search ?? '') }}" id="search-kelas-input"
                    placeholder="Cari nama, mapel, kode..."
                    class="border rounded-lg pl-9 pr-4 py-2 text-sm text-[#241508] placeholder-[#8B6340] focus:outline-none w-56"
                    style="background:#F3EDE2; border-color:#D4C0A0;" />
            </div>
            <button type="submit" class="text-xs font-semibold px-4 py-2 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">Cari</button>
            @if(request('q') || !empty($search))
                <a href="{{ url('/guru#kelas') }}" class="text-xs px-3 py-2 rounded-lg transition-colors" style="background:#EDE5D8; border:1px solid #D4C0A0; color:#6E4A2E;">Reset</a>
            @endif
        </form>
    </div>

    @if(request('q') || !empty($search))
        <div class="mb-4 flex items-center gap-2 text-xs px-4 py-2.5 rounded-lg" style="background:#F3EDE2; border:1px solid #D4C0A0; color:#6E4A2E;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <span>Hasil untuk <strong>"{{ request('q', $search ?? '') }}"</strong> — {{ isset($kelasList) ? $kelasList->count() : 0 }} kelas ditemukan</span>
            <a href="{{ url('/guru#kelas') }}" class="ml-auto font-semibold underline underline-offset-2" style="color:#4A2E1A;">Tampilkan semua</a>
        </div>
    @endif

    <!-- Daftar Kelas -->
    <div class="space-y-2 mb-6" id="kelas-list-container">
        @if(isset($kelasList) && $kelasList->count() > 0)
            @foreach($kelasList as $kelas)
                <div class="data-card kelas-item-card rounded-xl px-5 py-4" style="background:#F3EDE2; border:1px solid #D4C0A0;"
                    data-nama="{{ strtolower($kelas->nama_kelas) }}"
                    data-mapel="{{ strtolower($kelas->mata_pelajaran) }}"
                    data-kode="{{ strtolower($kelas->kode_kelas) }}">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1 flex-wrap">
                                <h3 class="font-semibold text-[#241508] text-sm">{{ $kelas->nama_kelas }}</h3>
                                <span class="inline-flex items-center text-[10px] font-mono font-semibold px-2 py-0.5 rounded-md" style="background:#4A2E1A; color:#FAF8F4;">
                                    {{ $kelas->kode_kelas }}
                                </span>
                                <span class="text-[11px] text-[#6E4A2E] font-medium">{{ $kelas->mata_pelajaran }}</span>
                            </div>
                            <p class="text-[11px] text-[#8B6340] flex items-center gap-3">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    </svg>
                                    {{ $kelas->materi->count() }} materi
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 11l3 3L22 4"/>
                                    </svg>
                                    {{ $kelas->kuis->count() }} kuis
                                </span>
                                @if($kelas->deskripsi)
                                    <span class="truncate max-w-xs italic">{{ $kelas->deskripsi }}</span>
                                @endif
                            </p>
                        </div>

                        <div class="flex items-center gap-1.5 shrink-0">
                            <button type="button" onclick='bukaModalDetailKelas(@json($kelas))'
                                class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg border transition-colors" style="color:#4A2E1A; background:#EDE5D8; border-color:#C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail
                            </button>
                            <button type="button" onclick='bukaModalEditKelas(@json($kelas))'
                                class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg border transition-colors" style="color:#4A2E1A; background:#EDE5D8; border-color:#C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('guru.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Hapus kelas {{ $kelas->nama_kelas }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg border transition-colors" style="color:#c62828; background:#fce4ec; border-color:#ef9a9a;">
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
            <div class="rounded-xl px-6 py-10 text-center" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3" style="color:#C4A882;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                </svg>
                <p class="text-sm font-medium text-[#4A2E1A]">Belum ada kelas</p>
                <p class="text-xs text-[#8B6340] mt-1">Buat kelas pertama Anda menggunakan form di bawah.</p>
            </div>
        @endif
    </div>

    <!-- Form Tambah Kelas -->
    @include('guru.kelas.create')
    @include('guru.kelas.edit')
    @include('guru.kelas.detail')
</div>

<script>
document.getElementById('search-kelas-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.kelas-item-card').forEach(card => {
        const match = ['data-nama','data-mapel','data-kode'].some(attr =>
            (card.getAttribute(attr) || '').includes(term)
        );
        card.style.display = match ? '' : 'none';
    });
});
</script>
