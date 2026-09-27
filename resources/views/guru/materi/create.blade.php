<!-- Form Unggah Materi Baru (Create Data) -->
<form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 mb-6 shadow-sm">
    @csrf
    <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-4">Form Tambah Materi Baru</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Judul Materi *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Modul Integral Tentu Bab 7"
                class="w-full bg-[#F7F3EC] border @error('judul') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            @error('judul') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Pilih Kelas *</label>
            <select name="kelas_id" required class="w-full bg-[#F7F3EC] border @error('kelas_id') border-red-500 @else border-[#D4C5A9] @enderror rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                <option value="">-- Pilih Kelas Tujuan --</option>
                @if(isset($kelasList))
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }} ({{ $k->mata_pelajaran }})</option>
                    @endforeach
                @endif
            </select>
            @error('kelas_id') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Deskripsi Materi (Opsional)</label>
            <textarea name="deskripsi" rows="2" placeholder="Tuliskan ringkasan materi atau petunjuk belajar bagi siswa..."
                class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Upload Berkas / Modul (Opsional: PDF, DOC, DOCX, PPT, PPTX, ZIP maks 20MB)</label>
            <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
                class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-xs text-[#2C1A0E] file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#7A5C3A] file:text-[#FAF7F2] hover:file:bg-[#5A3E28]" />
            @error('file_materi') <p class="text-red-700 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-5 py-2.5 rounded-lg hover:bg-[#5A3E28] transition-colors shadow-sm">+ Unggah Materi</button>
</form>
