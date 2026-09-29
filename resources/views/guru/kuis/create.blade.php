<!-- Form Buat Kuis Baru -->
<div class="bg-white border border-[#E6D9C6] rounded-xl p-5 mb-4">
    <p class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-4">1. Buat Kuis Baru</p>
    <form action="{{ route('guru.kuis.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Judul Kuis <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="cth: Kuis 1 — Penerapan Integral Tentu"
                class="form-input @error('judul') border-red-400 @enderror" />
            @error('judul') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select name="kelas_id" required class="form-input @error('kelas_id') border-red-400 @enderror">
                    <option value="">— Pilih Kelas —</option>
                    @if(isset($kelasList))
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('kelas_id') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Durasi <span class="text-[#A87C52] font-normal">(menit)</span> <span class="text-red-500">*</span></label>
                <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 30) }}" min="5" max="180" required
                    class="form-input @error('durasi_menit') border-red-400 @enderror" />
                @error('durasi_menit') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">KKM / Passing Grade <span class="text-red-500">*</span></label>
                <input type="number" name="passing_grade" value="{{ old('passing_grade', 75) }}" min="0" max="100" required
                    class="form-input @error('passing_grade') border-red-400 @enderror" />
                @error('passing_grade') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <button type="submit" class="flex items-center gap-2 bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Buat Kuis
        </button>
    </form>
</div>

<!-- Form Tambah Butir Soal -->
<div class="bg-white border border-[#E6D9C6] rounded-xl p-5 mb-6">
    <p class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-4">2. Tambah Butir Soal</p>
    <form action="{{ route('guru.soal.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Kuis Tujuan <span class="text-red-500">*</span></label>
                <select name="kuis_id" required class="form-input">
                    <option value="">— Pilih Kuis —</option>
                    @if(isset($kuisList))
                        @foreach($kuisList as $k)
                            <option value="{{ $k->id }}">{{ $k->judul }} · {{ $k->kelas->nama_kelas ?? 'Umum' }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Tipe Soal <span class="text-red-500">*</span></label>
                <select name="tipe" id="tipe-soal-select" onchange="toggleTipeSoal(this.value)" class="form-input">
                    <option value="pilihan_ganda">Pilihan Ganda (A, B, C, D)</option>
                    <option value="esai">Teks / Esai</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Pertanyaan <span class="text-red-500">*</span></label>
            <textarea name="pertanyaan" rows="2" required placeholder="Tuliskan pertanyaan soal di sini..."
                class="form-input resize-none"></textarea>
        </div>

        <!-- Opsi Pilihan Ganda -->
        <div id="section-opsi-pg" class="mb-4 bg-[#FAF8F4] border border-[#F3EDE2] rounded-xl p-4 space-y-3">
            <p class="text-[11px] font-semibold text-[#4A2E1A] uppercase tracking-wider">Pilihan Jawaban</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-[#6E4A2E] w-5 shrink-0">{{ $label }}.</span>
                        <input type="text" name="opsi_{{ $key }}" placeholder="Pilihan {{ $label }}"
                            class="flex-1 bg-white border border-[#E6D9C6] rounded-lg px-3 py-1.5 text-xs text-[#241508] focus:outline-none focus:border-[#8B6340]" />
                    </div>
                @endforeach
            </div>
            <div class="flex items-center gap-3 pt-2 border-t border-[#F3EDE2]">
                <label class="text-[11px] font-semibold text-[#4A2E1A]">Kunci Jawaban:</label>
                <select name="kunci_jawaban" id="kunci-select" class="bg-white border border-[#E6D9C6] rounded-lg px-3 py-1.5 text-xs font-bold text-[#241508] focus:outline-none focus:border-[#8B6340]">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>

        <!-- Opsi Esai -->
        <div id="section-opsi-esai" class="hidden mb-4 bg-[#FAF8F4] border border-[#F3EDE2] rounded-xl p-4">
            <label class="block text-[11px] font-semibold text-[#4A2E1A] mb-1.5">Pedoman Jawaban / Kata Kunci</label>
            <input type="text" name="kunci_jawaban_esai" id="kunci-esai" placeholder="cth: bilangan prima adalah bilangan yang hanya habis dibagi 1 dan dirinya sendiri"
                class="w-full bg-white border border-[#E6D9C6] rounded-lg px-3 py-2 text-xs text-[#241508] focus:outline-none focus:border-[#8B6340]" />
        </div>

        <button type="submit" class="flex items-center gap-2 bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambahkan Soal
        </button>
    </form>
</div>

<script>
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
</script>
