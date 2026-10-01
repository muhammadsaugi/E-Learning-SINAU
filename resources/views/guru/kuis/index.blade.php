<!-- ─── TAB BANK SOAL & KUIS ─── -->
<div id="tab-banksoal" class="tab-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div>
            <h1 class="font-display text-2xl text-[#241508]">Bank Soal & Kuis</h1>
            <p class="text-sm text-[#6E4A2E] mt-0.5">Kelola kuis dan butir soal untuk evaluasi siswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="search-kuis-input" placeholder="Cari kuis..." class="rounded-lg pl-9 pr-3 py-2 text-xs text-[#241508] placeholder-[#8B6340] focus:outline-none w-40" style="background:#F3EDE2; border:1px solid #D4C0A0;" />
            </div>
            <button onclick="bukaModalTambahKuis()" class="flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Buat Kuis
            </button>
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
                            <!-- Tambah Soal -->
                            <button type="button" onclick="bukaModalTambahSoal({{ $itemKuis->id }}, '{{ addslashes($itemKuis->judul) }}')"
                                class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                                Tambah Soal
                            </button>
                            <!-- Edit kuis -->
                            <button type="button" onclick='bukaModalEditKuis(@json($itemKuis))' class="flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-lg" style="color:#4A2E1A; background:#EDE5D8; border:1px solid #C4A882;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>
                            <!-- Hapus kuis -->
                            <form action="{{ route('guru.kuis.destroy', $itemKuis->id) }}" method="POST" onsubmit="return confirm('Hapus kuis beserta semua soalnya?')">
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

                    <!-- Soal list (collapsible) -->
                    @if($itemKuis->soal->count() > 0)
                        <div class="px-5 py-3 space-y-2">
                            @foreach($itemKuis->soal as $idx => $soal)
                                <div class="flex items-start justify-between gap-3 py-2.5 last:pb-0" style="border-bottom:1px solid #D4C0A0;">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="text-[10px] font-bold text-[#8B6340]">#{{ $idx + 1 }}</span>
                                            <span class="text-[9px] font-semibold px-1.5 py-0.5 rounded-md {{ $soal->tipe === 'pilihan_ganda' ? '' : '' }}" style="{{ $soal->tipe === 'pilihan_ganda' ? 'background:#EDE5D8; color:#4A2E1A;' : 'background:#e3f2fd; color:#1565c0;' }}">
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
                                            <p class="text-[10px] font-semibold mt-1.5" style="color:#2e7d32;">Kunci: Opsi {{ $soal->kunci_jawaban }}</p>
                                        @else
                                            <p class="text-[10px] text-[#8B6340] italic mt-1">Pedoman: {{ $soal->kunci_jawaban }}</p>
                                        @endif
                                    </div>
                                    <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                        @csrf @method('DELETE')
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
                            <p class="text-xs text-[#8B6340] italic">Belum ada soal.</p>
                            <button onclick="bukaModalTambahSoal({{ $itemKuis->id }}, '{{ addslashes($itemKuis->judul) }}')" class="text-xs font-semibold underline" style="color:#4A2E1A;">Tambah sekarang</button>
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
                <button onclick="bukaModalTambahKuis()" class="text-xs font-semibold px-5 py-2 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    + Buat Kuis Sekarang
                </button>
            </div>
        @endif
    </div>
</div>

<!-- ═══════════════════ MODAL BUAT KUIS ═══════════════════ -->
<div id="modal-tambah-kuis" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden" style="background:#FAF8F4;">
        <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Buat Kuis Baru</h2>
                <p class="text-xs mt-0.5" style="color:#A87C52;">Isi informasi kuis, lalu tambahkan soal.</p>
            </div>
            <button type="button" onclick="tutupModalTambahKuis()" class="w-8 h-8 flex items-center justify-center rounded-lg" style="color:#D4C0A0; background:rgba(255,255,255,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('guru.kuis.store') }}" method="POST" class="px-6 py-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Judul Kuis <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="cth: Kuis 1 — Penerapan Integral Tentu" class="form-input" />
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas_id" required class="form-input">
                        <option value="">— Pilih —</option>
                        @if(isset($kelasList))
                            @foreach($kelasList as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Durasi (menit) <span class="text-red-500">*</span></label>
                    <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 30) }}" min="5" max="180" required class="form-input" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">KKM <span class="text-red-500">*</span></label>
                    <input type="number" name="passing_grade" value="{{ old('passing_grade', 75) }}" min="0" max="100" required class="form-input" />
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-2" style="border-top:1px solid #E6D9C6;">
                <button type="button" onclick="tutupModalTambahKuis()" class="text-xs font-medium px-4 py-2 rounded-lg" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Buat Kuis
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════ MODAL TAMBAH SOAL ═══════════════════ -->
<div id="modal-tambah-soal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-2xl mx-4 rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col" style="background:#FAF8F4;">
        <div class="flex items-center justify-between px-6 py-5 shrink-0" style="background:#6E4A2E;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Tambah Soal</h2>
                <p id="modal-soal-subtitle" class="text-xs mt-0.5" style="color:#D4C0A0;">Pilihan ganda atau esai</p>
            </div>
            <button type="button" onclick="tutupModalTambahSoal()" class="w-8 h-8 flex items-center justify-center rounded-lg" style="color:#D4C0A0; background:rgba(255,255,255,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form action="{{ route('guru.soal.store') }}" method="POST" class="px-6 py-6 space-y-4 overflow-y-auto">
            @csrf
            <input type="hidden" name="kuis_id" id="modal-soal-kuis-id" />
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kuis Tujuan</label>
                    <input type="text" id="modal-soal-kuis-label" readonly class="form-input" style="background:#F3EDE2; cursor:not-allowed; color:#6E4A2E;" />
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Tipe Soal <span class="text-red-500">*</span></label>
                    <select name="tipe" id="tipe-soal-select" onchange="toggleTipeSoal(this.value)" class="form-input">
                        <option value="pilihan_ganda">Pilihan Ganda (A, B, C, D)</option>
                        <option value="esai">Teks / Esai</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Pertanyaan <span class="text-red-500">*</span></label>
                <textarea name="pertanyaan" rows="2" required placeholder="Tuliskan pertanyaan soal di sini..." class="form-input resize-none"></textarea>
            </div>
            <!-- Opsi PG -->
            <div id="section-opsi-pg" class="rounded-xl p-4 space-y-3" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                <p class="text-[11px] font-bold text-[#4A2E1A] uppercase tracking-wider">Pilihan Jawaban</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-[#6E4A2E] w-5 shrink-0">{{ $label }}.</span>
                            <input type="text" name="opsi_{{ $key }}" placeholder="Pilihan {{ $label }}" class="flex-1 rounded-lg px-3 py-1.5 text-xs text-[#241508] focus:outline-none" style="background:white; border:1px solid #D4C0A0;" />
                        </div>
                    @endforeach
                </div>
                <div class="flex items-center gap-3 pt-2" style="border-top:1px solid #D4C0A0;">
                    <label class="text-[11px] font-bold text-[#4A2E1A]">Kunci Jawaban:</label>
                    <select name="kunci_jawaban" id="kunci-select" class="rounded-lg px-3 py-1.5 text-xs font-bold text-[#241508] focus:outline-none" style="background:white; border:1px solid #D4C0A0;">
                        <option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option>
                    </select>
                </div>
            </div>
            <!-- Opsi Esai -->
            <div id="section-opsi-esai" class="hidden rounded-xl p-4" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                <label class="block text-[11px] font-bold text-[#4A2E1A] mb-1.5">Pedoman Jawaban / Kata Kunci</label>
                <input type="text" name="kunci_jawaban_esai" id="kunci-esai" placeholder="cth: bilangan prima adalah..." class="w-full rounded-lg px-3 py-2 text-xs text-[#241508] focus:outline-none" style="background:white; border:1px solid #D4C0A0;" />
            </div>
            <div class="flex justify-end gap-2 pt-2" style="border-top:1px solid #E6D9C6;">
                <button type="button" onclick="tutupModalTambahSoal()" class="text-xs font-medium px-4 py-2 rounded-lg" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Tambahkan Soal
                </button>
            </div>
        </form>
    </div>
</div>

    <!-- Include Modals -->
    @include('guru.kuis.edit')
</div>

<script>
// ── Kuis Modal ──
function bukaModalTambahKuis() {
    document.getElementById('modal-tambah-kuis').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalTambahKuis() {
    document.getElementById('modal-tambah-kuis').classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Soal Modal ──
function bukaModalTambahSoal(kuisId, kuisJudul) {
    document.getElementById('modal-soal-kuis-id').value = kuisId;
    document.getElementById('modal-soal-kuis-label').value = kuisJudul;
    document.getElementById('modal-soal-subtitle').textContent = 'Untuk kuis: ' + kuisJudul;
    document.getElementById('modal-tambah-soal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalTambahSoal() {
    document.getElementById('modal-tambah-soal').classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Edit Kuis Modal ──
function bukaModalEditKuis(kuis) {
    document.getElementById('form-edit-kuis').action = `/guru/kuis/${kuis.id}`;
    document.getElementById('edit-kuis-kelas').value = kuis.kelas_id || '';
    document.getElementById('edit-kuis-judul').value = kuis.judul || '';
    document.getElementById('edit-kuis-durasi').value = kuis.durasi_menit || '20';
    document.getElementById('edit-kuis-passing').value = kuis.passing_grade || '70';
    document.getElementById('modal-edit-kuis').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalEditKuis() {
    document.getElementById('modal-edit-kuis').classList.add('hidden');
    document.body.style.overflow = '';
}

// ── Tipe Soal ──
function toggleTipeSoal(tipe) {
    const pg = document.getElementById('section-opsi-pg');
    const esai = document.getElementById('section-opsi-esai');
    const kunciSelect = document.getElementById('kunci-select');
    const kunciEsai = document.getElementById('kunci-esai');
    if (tipe === 'pilihan_ganda') {
        pg.classList.remove('hidden'); esai.classList.add('hidden');
        kunciSelect.name = 'kunci_jawaban'; kunciEsai.removeAttribute('name');
    } else {
        pg.classList.add('hidden'); esai.classList.remove('hidden');
        kunciSelect.removeAttribute('name'); kunciEsai.name = 'kunci_jawaban';
    }
}

// ── Search ──
document.getElementById('search-kuis-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.kuis-item-card').forEach(card => {
        const match = ['data-judul','data-kelas'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});

// Close on backdrop click
['modal-tambah-kuis','modal-tambah-soal','modal-edit-kuis'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
});
</script>
