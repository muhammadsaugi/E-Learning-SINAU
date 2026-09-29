<!-- Form Tambah Kelas Baru -->
<div class="bg-white border border-[#E6D9C6] rounded-xl p-5">
    <p class="text-[11px] font-semibold text-[#A87C52] uppercase tracking-widest mb-4">Tambah Kelas Baru</p>
    <form action="{{ route('guru.kelas.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required placeholder="cth: XII IPA 4"
                    class="form-input @error('nama_kelas') border-red-400 @enderror" />
                @error('nama_kelas') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                <select name="mata_pelajaran" class="form-input @error('mata_pelajaran') border-red-400 @enderror">
                    @foreach(['Matematika','Biologi','Fisika','Kimia','Bahasa Indonesia','Bahasa Inggris','Sejarah','Geografi','Ekonomi','Sosiologi','Informatika','Seni Budaya','PJOK','PPKn','Prakarya','Bahasa Asing'] as $mp)
                        <option value="{{ $mp }}" {{ old('mata_pelajaran') == $mp ? 'selected' : '' }}>{{ $mp }}</option>
                    @endforeach
                </select>
                @error('mata_pelajaran') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Deskripsi / Jadwal <span class="text-[#A87C52] font-normal">(opsional)</span></label>
                <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="cth: Setiap Senin 08.00–09.30"
                    class="form-input" />
            </div>
        </div>
        <button type="submit" class="flex items-center gap-2 bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Buat Kelas
        </button>
    </form>
</div>
