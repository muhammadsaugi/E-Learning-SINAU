<!-- Form Tambah Kelas Baru (Create Data) -->
<form action="{{ route('guru.kelas.store') }}" method="POST" class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 shadow-sm">
    @csrf
    <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-4">Buat Kelas Baru</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Nama Kelas *</label>
            <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required placeholder="Contoh: XII IPA 4" 
                class="w-full bg-[#F7F3EC] border @error('nama_kelas') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            @error('nama_kelas') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Mata Pelajaran *</label>
            <select name="mata_pelajaran" class="w-full bg-[#F7F3EC] border @error('mata_pelajaran') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                <option value="Matematika" {{ old('mata_pelajaran') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                <option value="Biologi" {{ old('mata_pelajaran') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
                <option value="Fisika" {{ old('mata_pelajaran') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
                <option value="Kimia" {{ old('mata_pelajaran') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
                <option value="Bahasa Indonesia" {{ old('mata_pelajaran') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                <option value="Bahasa Inggris" {{ old('mata_pelajaran') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
            </select>
            @error('mata_pelajaran') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Deskripsi / Jadwal (Opsional)</label>
            <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Contoh: Setiap Senin 08.00–09.30" 
                class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            @error('deskripsi') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-5 py-2.5 rounded-lg hover:bg-[#5A3E28] transition-colors shadow-sm">+ Buat Kelas</button>
</form>
