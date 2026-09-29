<!-- ─── TAB UNGGAH MATERI ─── -->
<div id="tab-materi" class="tab-content">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="font-display text-2xl text-[#241508] leading-tight">Materi Pembelajaran</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Unggah dan kelola dokumen materi untuk siswa.</p>
        </div>
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="search-materi-input" placeholder="Cari judul materi..."
                class="bg-[#FAF8F4] border border-[#E6D9C6] rounded-lg pl-9 pr-4 py-2 text-sm text-[#241508] placeholder-[#A87C52] focus:outline-none focus:border-[#8B6340] w-56" />
        </div>
    </div>

    <!-- Form Tambah Materi -->
    @include('guru.materi.create')

    <!-- Daftar Materi -->
    <div class="mt-6">
        <h2 class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-3">Materi Tersimpan</h2>
        <div class="space-y-2" id="materi-list-container">
            @if(isset($materiList) && $materiList->count() > 0)
                @foreach($materiList as $mat)
                    <div class="data-card materi-item-card bg-white border border-[#E6D9C6] rounded-xl px-5 py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3"
                        data-judul="{{ strtolower($mat->judul) }}"
                        data-kelas="{{ strtolower($mat->kelas->nama_kelas ?? '') }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-lg bg-[#F3EDE2] border border-[#E6D9C6] flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-[#241508] truncate">{{ $mat->judul }}</h4>
                                <p class="text-[11px] text-[#A87C52] mt-0.5">
                                    {{ $mat->kelas->nama_kelas ?? 'Umum' }}
                                    @if($mat->created_at)
                                        · {{ $mat->created_at->format('d M Y') }}
                                    @endif
                                    @if($mat->deskripsi)
                                        · <span class="italic">{{ Str::limit($mat->deskripsi, 50) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 shrink-0">
                            @if($mat->file_path)
                                <a href="{{ route('materi.download', $mat->id) }}" class="flex items-center gap-1.5 text-xs font-medium text-[#4A2E1A] px-3 py-1.5 rounded-lg border border-[#D4C0A0] bg-[#FAF8F4] hover:bg-[#F3EDE2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                    Unduh
                                </a>
                            @endif
                            <button type="button" onclick='bukaModalEditMateri(@json($mat))'
                                class="flex items-center gap-1.5 text-xs font-medium text-[#4A2E1A] px-3 py-1.5 rounded-lg border border-[#D4C0A0] bg-[#FAF8F4] hover:bg-[#F3EDE2] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>
                            <form action="{{ route('guru.materi.destroy', $mat->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-1.5 text-xs font-medium text-red-700 px-3 py-1.5 rounded-lg border border-red-200 bg-red-50/50 hover:bg-red-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-[#E6D9C6] rounded-xl px-6 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A]">Belum ada materi</p>
                    <p class="text-xs text-[#8B6340] mt-1">Unggah materi pertama Anda menggunakan form di atas.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Edit Materi -->
<div id="modal-edit-materi" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px] hidden">
    <div class="bg-white border border-[#E6D9C6] rounded-2xl p-6 w-full max-w-lg shadow-2xl mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-[#F3EDE2] mb-5">
            <div>
                <h3 class="font-display text-lg text-[#241508]">Edit Materi</h3>
                <p class="text-xs text-[#8B6340] mt-0.5">Perbarui informasi modul materi.</p>
            </div>
            <button type="button" onclick="tutupModalEditMateri()" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#A87C52] hover:text-[#241508] hover:bg-[#F3EDE2] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="form-edit-materi" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select id="edit-materi-kelas" name="kelas_id" required class="form-input">
                    @if(isset($kelasList))
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Judul Materi <span class="text-red-500">*</span></label>
                <input type="text" id="edit-materi-judul" name="judul" required class="form-input" />
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Ganti File <span class="text-[#A87C52] font-normal">(opsional)</span></label>
                <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip" class="form-input text-sm" />
                <p class="text-[10px] text-[#A87C52] mt-1">Biarkan kosong jika tidak ingin mengganti file lama.</p>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Deskripsi</label>
                <textarea id="edit-materi-deskripsi" name="deskripsi" rows="2" class="form-input resize-none"></textarea>
            </div>
            <div class="pt-4 border-t border-[#F3EDE2] flex items-center justify-end gap-2">
                <button type="button" onclick="tutupModalEditMateri()" class="text-xs text-[#8B6340] px-4 py-2 rounded-lg hover:text-[#4A2E1A] transition-colors">Batal</button>
                <button type="submit" class="flex items-center gap-2 bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalEditMateri(materi) {
    document.getElementById('form-edit-materi').action = `/guru/materi/${materi.id}`;
    document.getElementById('edit-materi-kelas').value = materi.kelas_id || '';
    document.getElementById('edit-materi-judul').value = materi.judul || '';
    document.getElementById('edit-materi-deskripsi').value = materi.deskripsi || '';
    document.getElementById('modal-edit-materi').classList.remove('hidden');
}
function tutupModalEditMateri() {
    document.getElementById('modal-edit-materi').classList.add('hidden');
}
document.getElementById('search-materi-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.materi-item-card').forEach(card => {
        const match = ['data-judul','data-kelas'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
