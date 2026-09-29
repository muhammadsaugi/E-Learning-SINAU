<!-- ─── TAB BANK SOAL & KUIS ─── -->
<div id="tab-banksoal" class="tab-content">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="font-display text-2xl text-[#241508] leading-tight">Bank Soal & Kuis</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Buat kuis, tambahkan soal pilihan ganda maupun esai.</p>
        </div>
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="search-kuis-input" placeholder="Cari kuis..."
                class="bg-[#FAF8F4] border border-[#E6D9C6] rounded-lg pl-9 pr-4 py-2 text-sm text-[#241508] placeholder-[#A87C52] focus:outline-none focus:border-[#8B6340] w-52" />
        </div>
    </div>

    @include('guru.kuis.create')

    <!-- Daftar Kuis Tersimpan -->
    <div class="mt-2">
        <h2 class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-3">Kuis Tersimpan</h2>
        <div id="kuis-list-container" class="space-y-3">
            @if(isset($kuisList) && $kuisList->count() > 0)
                @foreach($kuisList as $itemKuis)
                    <div class="data-card kuis-item-card bg-white border border-[#E6D9C6] rounded-xl overflow-hidden"
                        data-judul="{{ strtolower($itemKuis->judul) }}"
                        data-kelas="{{ strtolower($itemKuis->kelas->nama_kelas ?? '') }}">

                        <!-- Kuis Header -->
                        <div class="flex items-center justify-between px-5 py-4 border-b border-[#F3EDE2]">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-[#241508] text-sm">{{ $itemKuis->judul }}</h3>
                                <p class="text-[11px] text-[#A87C52] mt-0.5 flex items-center gap-3 flex-wrap">
                                    <span>{{ $itemKuis->kelas->nama_kelas ?? 'Umum' }}</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                        </svg>
                                        {{ $itemKuis->durasi_menit }} menit
                                    </span>
                                    <span>KKM {{ $itemKuis->passing_grade }}</span>
                                    <span class="font-semibold text-[#6E4A2E]">{{ $itemKuis->soal->count() }} soal</span>
                                </p>
                            </div>
                            <div class="flex items-center gap-1.5 ml-3 shrink-0">
                                <button type="button" onclick='bukaModalEditKuis(@json($itemKuis))'
                                    class="flex items-center gap-1.5 text-xs font-medium text-[#4A2E1A] px-2.5 py-1.5 rounded-lg border border-[#D4C0A0] bg-[#FAF8F4] hover:bg-[#F3EDE2] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </button>
                                <form action="{{ route('guru.kuis.destroy', $itemKuis->id) }}" method="POST" onsubmit="return confirm('Hapus kuis beserta semua soalnya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1.5 text-xs font-medium text-red-700 px-2.5 py-1.5 rounded-lg border border-red-200 bg-red-50/50 hover:bg-red-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Soal List -->
                        <div class="px-5 py-3 space-y-2">
                            @if($itemKuis->soal->count() > 0)
                                @foreach($itemKuis->soal as $idx => $soal)
                                    <div class="flex items-start justify-between gap-3 py-2.5 border-b border-[#FAF8F4] last:border-0">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-[10px] font-semibold text-[#8B6340]">#{{ $idx + 1 }}</span>
                                                <span class="text-[9px] font-semibold px-1.5 py-0.5 rounded-md {{ $soal->tipe === 'pilihan_ganda' ? 'bg-[#F3EDE2] text-[#6E4A2E]' : 'bg-blue-50 text-blue-700' }}">
                                                    {{ $soal->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Esai' }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-[#241508]">{{ $soal->pertanyaan }}</p>
                                            @if($soal->tipe === 'pilihan_ganda')
                                                <div class="grid grid-cols-2 gap-x-4 mt-2 text-[11px] text-[#6E4A2E]">
                                                    <span><span class="font-bold">A</span> {{ $soal->opsi_a }}</span>
                                                    <span><span class="font-bold">B</span> {{ $soal->opsi_b }}</span>
                                                    @if($soal->opsi_c)<span><span class="font-bold">C</span> {{ $soal->opsi_c }}</span>@endif
                                                    @if($soal->opsi_d)<span><span class="font-bold">D</span> {{ $soal->opsi_d }}</span>@endif
                                                </div>
                                                <p class="text-[10px] text-green-700 font-semibold mt-1.5">Kunci: Opsi {{ $soal->kunci_jawaban }}</p>
                                            @else
                                                <p class="text-[10px] text-[#8B6340] italic mt-1">Pedoman: {{ $soal->kunci_jawaban }}</p>
                                            @endif
                                        </div>
                                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-700 transition-colors p-1.5 rounded" title="Hapus soal">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs text-[#A87C52] italic py-2">Belum ada soal. Tambahkan melalui form di atas.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-[#E6D9C6] rounded-xl px-6 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A]">Belum ada kuis</p>
                    <p class="text-xs text-[#8B6340] mt-1">Buat kuis pertama menggunakan form di atas.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal Edit Kuis -->
<div id="modal-edit-kuis" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px] hidden">
    <div class="bg-white border border-[#E6D9C6] rounded-2xl p-6 w-full max-w-lg shadow-2xl mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-[#F3EDE2] mb-5">
            <div>
                <h3 class="font-display text-lg text-[#241508]">Edit Kuis</h3>
                <p class="text-xs text-[#8B6340] mt-0.5">Perbarui informasi kuis.</p>
            </div>
            <button type="button" onclick="tutupModalEditKuis()" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#A87C52] hover:text-[#241508] hover:bg-[#F3EDE2] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="form-edit-kuis" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select id="edit-kuis-kelas" name="kelas_id" required class="form-input">
                    @if(isset($kelasList))
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Judul Kuis <span class="text-red-500">*</span></label>
                <input type="text" id="edit-kuis-judul" name="judul" required class="form-input" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Durasi (menit)</label>
                    <input type="number" id="edit-kuis-durasi" name="durasi_menit" min="5" max="180" class="form-input" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">KKM / Passing Grade</label>
                    <input type="number" id="edit-kuis-passing" name="passing_grade" min="0" max="100" class="form-input" />
                </div>
            </div>
            <div class="pt-4 border-t border-[#F3EDE2] flex items-center justify-end gap-2">
                <button type="button" onclick="tutupModalEditKuis()" class="text-xs text-[#8B6340] px-4 py-2 rounded-lg hover:text-[#4A2E1A] transition-colors">Batal</button>
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
function bukaModalEditKuis(kuis) {
    document.getElementById('form-edit-kuis').action = `/guru/kuis/${kuis.id}`;
    document.getElementById('edit-kuis-kelas').value = kuis.kelas_id || '';
    document.getElementById('edit-kuis-judul').value = kuis.judul || '';
    document.getElementById('edit-kuis-durasi').value = kuis.durasi_menit || '20';
    document.getElementById('edit-kuis-passing').value = kuis.passing_grade || '70';
    document.getElementById('modal-edit-kuis').classList.remove('hidden');
}
function tutupModalEditKuis() {
    document.getElementById('modal-edit-kuis').classList.add('hidden');
}
document.getElementById('search-kuis-input')?.addEventListener('input', function(e) {
    const term = e.target.value.toLowerCase().trim();
    document.querySelectorAll('.kuis-item-card').forEach(card => {
        const match = ['data-judul','data-kelas'].some(a => (card.getAttribute(a)||'').includes(term));
        card.style.display = match ? '' : 'none';
    });
});
</script>
