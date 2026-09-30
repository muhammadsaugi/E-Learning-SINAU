<!-- ─── TAB UNGGAH MATERI ─── -->
<div id="tab-materi" class="tab-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Materi Pembelajaran</h1>
            <p class="text-sm text-[#6E4A2E] mt-0.5">Kelola modul dan dokumen yang tersedia untuk siswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-materi-input" placeholder="Cari materi..." class="rounded-lg pl-9 pr-3 py-2 text-xs text-[#241508] placeholder-[#8B6340] focus:outline-none w-40" style="background:#F3EDE2; border:1px solid #D4C0A0;" />
            </div>
            <button onclick="bukaModalTambahMateri()" class="flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Unggah Materi
            </button>
        </div>
    </div>

    <!-- Daftar Materi -->
    <div class="space-y-2" id="materi-list-container">
        @if(isset($materiList) && $materiList->count() > 0)
            @foreach($materiList as $mat)
                <div class="data-card materi-item-card rounded-xl px-5 py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3"
                    style="background:#F3EDE2; border:1px solid #D4C0A0;"
                    data-judul="{{ strtolower($mat->judul) }}"
                    data-kelas="{{ strtolower($mat->kelas->nama_kelas ?? '') }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0" style="background:#4A2E1A;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color:#FAF8F4;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-sm font-semibold text-[#241508] truncate">{{ $mat->judul }}</h4>
                            <p class="text-[11px] text-[#8B6340] mt-0.5 flex items-center gap-2 flex-wrap">
                                <span class="font-medium text-[#6E4A2E]">{{ $mat->kelas->nama_kelas ?? 'Umum' }}</span>
                                @if($mat->created_at) <span>· {{ $mat->created_at->format('d M Y') }}</span> @endif
                                @if($mat->deskripsi) <span class="italic truncate max-w-xs">· {{ Str::limit($mat->deskripsi, 60) }}</span> @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 shrink-0">
                        @if($mat->file_path)
                            <a href="{{ route('materi.download', $mat->id) }}" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                </svg>
                                Unduh
                            </a>
                        @endif
                        <button type="button" onclick='bukaModalEditMateri(@json($mat))' class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit
                        </button>
                        <form action="{{ route('guru.materi.destroy', $mat->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg" style="color:#c62828; background:#fce4ec; border:1px solid #ef9a9a;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="rounded-xl px-6 py-12 text-center" style="background:#F3EDE2; border:2px dashed #D4C0A0;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-3" style="color:#C4A882;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                </svg>
                <p class="text-sm font-semibold text-[#4A2E1A] mb-1">Belum ada materi</p>
                <p class="text-xs text-[#8B6340] mb-4">Unggah modul pertama untuk siswa Anda.</p>
                <button onclick="bukaModalTambahMateri()" class="text-xs font-semibold px-5 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    + Unggah Materi Sekarang
                </button>
            </div>
        @endif
    </div>
</div>

<!-- ═══════════════════ MODAL TAMBAH MATERI ═══════════════════ -->
<div id="modal-tambah-materi" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden" style="background:#FAF8F4;">
        <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Unggah Materi Baru</h2>
                <p class="text-xs mt-0.5" style="color:#A87C52;">Tambahkan modul atau dokumen untuk siswa.</p>
            </div>
            <button type="button" onclick="tutupModalTambahMateri()" class="w-8 h-8 flex items-center justify-center rounded-lg" style="color:#D4C0A0; background:rgba(255,255,255,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        @include('guru.materi.create')
    </div>
</div>

<!-- ═══════════════════ MODAL EDIT MATERI ═══════════════════ -->
<div id="modal-edit-materi" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden" style="background:#FAF8F4;">
        <div class="flex items-center justify-between px-6 py-5" style="background:#6E4A2E;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Edit Materi</h2>
                <p class="text-xs mt-0.5" style="color:#D4C0A0;">Perbarui informasi modul materi.</p>
            </div>
            <button type="button" onclick="tutupModalEditMateri()" class="w-8 h-8 flex items-center justify-center rounded-lg" style="color:#D4C0A0; background:rgba(255,255,255,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="form-edit-materi" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select id="edit-materi-kelas" name="kelas_id" required class="form-input">
                    @if(isset($kelasList))
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Judul Materi <span class="text-red-500">*</span></label>
                <input type="text" id="edit-materi-judul" name="judul" required class="form-input" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Ganti File <span class="text-[#8B6340] font-normal">(opsional — biarkan kosong jika tidak ingin ganti)</span></label>
                <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip" class="form-input text-sm" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Deskripsi</label>
                <textarea id="edit-materi-deskripsi" name="deskripsi" rows="2" class="form-input resize-none"></textarea>
            </div>
            <div class="flex justify-end gap-2 pt-2" style="border-top:1px solid #E6D9C6;">
                <button type="button" onclick="tutupModalEditMateri()" class="text-xs font-medium px-4 py-2 rounded-lg" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalTambahMateri() {
    document.getElementById('modal-tambah-materi').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalTambahMateri() {
    document.getElementById('modal-tambah-materi').classList.add('hidden');
    document.body.style.overflow = '';
}
function bukaModalEditMateri(materi) {
    document.getElementById('form-edit-materi').action = `/guru/materi/${materi.id}`;
    document.getElementById('edit-materi-kelas').value = materi.kelas_id || '';
    document.getElementById('edit-materi-judul').value = materi.judul || '';
    document.getElementById('edit-materi-deskripsi').value = materi.deskripsi || '';
    document.getElementById('modal-edit-materi').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalEditMateri() {
    document.getElementById('modal-edit-materi').classList.add('hidden');
    document.body.style.overflow = '';
}
document.getElementById('modal-tambah-materi')?.addEventListener('click', function(e) {
    if (e.target === this) tutupModalTambahMateri();
});
document.getElementById('modal-edit-materi')?.addEventListener('click', function(e) {
    if (e.target === this) tutupModalEditMateri();
});
document.getElementById('search-materi-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.materi-item-card').forEach(card => {
        const match = ['data-judul','data-kelas'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
