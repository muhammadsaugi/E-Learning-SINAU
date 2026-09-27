<!-- 1. Form Buat Kuis Baru (Create Kuis) -->
<form action="{{ route('guru.kuis.store') }}" method="POST" class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 mb-5 shadow-sm">
    @csrf
    <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">1. Buat Kuis / Ujian Baru</p>
    
    <div class="mb-3">
        <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Judul Kuis / Topik Ujian *</label>
        <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Kuis 1: Penerapan Integral Tentu"
            class="w-full bg-[#F7F3EC] border @error('judul') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
        @error('judul') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Pilih Kelas *</label>
            <select name="kelas_id" required class="w-full bg-[#F7F3EC] border @error('kelas_id') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                <option value="">-- Pilih Kelas --</option>
                @if(isset($kelasList))
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }} ({{ $k->mata_pelajaran }})</option>
                    @endforeach
                @endif
            </select>
            @error('kelas_id') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Durasi (Menit) *</label>
            <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 30) }}" min="5" max="180" required
                class="w-full bg-[#F7F3EC] border @error('durasi_menit') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            @error('durasi_menit') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Passing Grade / KKM (0-100) *</label>
            <input type="number" name="passing_grade" value="{{ old('passing_grade', 75) }}" min="0" max="100" required
                class="w-full bg-[#F7F3EC] border @error('passing_grade') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            @error('passing_grade') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">+ Simpan Kuis Baru</button>
</form>

<!-- 2. Form Tambah Butir Soal (Pilihan Ganda atau Teks/Esai) -->
<form action="{{ route('guru.soal.store') }}" method="POST" class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 mb-6 shadow-sm">
    @csrf
    <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">2. Tambah Butir Pertanyaan (Pilihan Ganda / Teks)</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Pilih Kuis Tujuan *</label>
            <select name="kuis_id" required class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                <option value="">-- Pilih Kuis --</option>
                @if(isset($kuisList))
                    @foreach($kuisList as $k)
                        <option value="{{ $k->id }}">{{ $k->judul }} (Kelas: {{ $k->kelas->nama_kelas ?? 'Umum' }})</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Tipe Soal *</label>
            <select name="tipe" id="tipe-soal-select" onchange="toggleTipeSoal(this.value)" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                <option value="pilihan_ganda">Pilihan Ganda (A, B, C, D)</option>
                <option value="esai">Teks Biasa / Esai</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Teks Pertanyaan / Soal *</label>
        <textarea name="pertanyaan" rows="2" required placeholder="Tuliskan pertanyaan soal di sini..."
            class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-4 py-2.5 text-sm text-[#2C1A0E] resize-none focus:outline-none focus:border-[#7A5C3A]"></textarea>
    </div>

    <!-- Opsi Pilihan Ganda -->
    <div id="section-opsi-pg" class="space-y-2 mb-4 bg-[#F7F3EC]/70 p-3 rounded-lg border border-[#D4C5A9]">
        <p class="text-[10px] font-semibold text-[#7A6050]">Pilihan Jawaban & Kunci:</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-[#7A5C3A] w-4">A.</span>
                <input type="text" name="opsi_a" placeholder="Pilihan A" class="flex-1 bg-white border border-[#D4C5A9] rounded-md px-3 py-1.5 text-xs text-[#2C1A0E]" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-[#7A5C3A] w-4">B.</span>
                <input type="text" name="opsi_b" placeholder="Pilihan B" class="flex-1 bg-white border border-[#D4C5A9] rounded-md px-3 py-1.5 text-xs text-[#2C1A0E]" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-[#7A5C3A] w-4">C.</span>
                <input type="text" name="opsi_c" placeholder="Pilihan C" class="flex-1 bg-white border border-[#D4C5A9] rounded-md px-3 py-1.5 text-xs text-[#2C1A0E]" />
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-[#7A5C3A] w-4">D.</span>
                <input type="text" name="opsi_d" placeholder="Pilihan D" class="flex-1 bg-white border border-[#D4C5A9] rounded-md px-3 py-1.5 text-xs text-[#2C1A0E]" />
            </div>
        </div>
        <div class="mt-2 pt-2 border-t border-[#D4C5A9]/50 flex items-center gap-3">
            <label class="text-[10px] font-semibold text-[#2C1A0E]">Kunci Jawaban Benar:</label>
            <select name="kunci_jawaban" id="kunci-select" class="bg-white border border-[#D4C5A9] rounded-md px-3 py-1 text-xs text-[#2C1A0E] font-bold">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>
    </div>

    <!-- Opsi Jawaban Esai / Teks -->
    <div id="section-opsi-esai" class="hidden mb-4 bg-[#F7F3EC]/70 p-3 rounded-lg border border-[#D4C5A9]">
        <label class="text-[10px] font-semibold text-[#7A6050] mb-1 block">Pedoman Jawaban Benar / Kata Kunci:</label>
        <input type="text" name="kunci_jawaban_esai" id="kunci-esai" placeholder="Contoh: integral tertentu menghasilkan nilai konstan / numerik" 
            class="w-full bg-white border border-[#D4C5A9] rounded-md px-3 py-1.5 text-xs text-[#2C1A0E]" />
    </div>

    <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors shadow-sm">+ Tambahkan Soal ke Kuis</button>
</form>

<script>
function toggleTipeSoal(tipe) {
    const pg = document.getElementById('section-opsi-pg');
    const esai = document.getElementById('section-opsi-esai');
    const kunciSelect = document.getElementById('kunci-select');
    const kunciEsai = document.getElementById('kunci-esai');
    
    if (tipe === 'pilihan_ganda') {
        pg.classList.remove('hidden');
        esai.classList.add('hidden');
        kunciSelect.name = 'kunci_jawaban';
        kunciEsai.removeAttribute('name');
    } else {
        pg.classList.add('hidden');
        esai.classList.remove('hidden');
        kunciSelect.removeAttribute('name');
        kunciEsai.name = 'kunci_jawaban';
    }
}
</script>
