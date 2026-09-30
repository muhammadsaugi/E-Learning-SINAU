{{-- Form body untuk modal tambah materi (tanpa wrapper) --}}
<form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-6 space-y-4">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Judul Materi <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="cth: Modul Integral Tentu Bab 7"
                class="form-input @error('judul') border-red-400 @enderror" />
            @error('judul') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kelas Tujuan <span class="text-red-500">*</span></label>
            <select name="kelas_id" required class="form-input @error('kelas_id') border-red-400 @enderror">
                <option value="">— Pilih Kelas —</option>
                @if(isset($kelasList))
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} ({{ $k->mata_pelajaran }})
                        </option>
                    @endforeach
                @endif
            </select>
            @error('kelas_id') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div>
        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Deskripsi <span class="text-[#8B6340] font-normal">(opsional)</span></label>
        <textarea name="deskripsi" rows="2" class="form-input resize-none">{{ old('deskripsi') }}</textarea>
    </div>
    <div>
        <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">
            Berkas / Modul <span class="text-[#8B6340] font-normal">(PDF, DOC, DOCX, PPT, PPTX, ZIP · maks 20MB)</span>
        </label>
        <input type="file" name="file_materi" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip"
            class="form-input text-sm file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#4A2E1A] file:text-[#FAF8F4] hover:file:bg-[#241508] cursor-pointer" />
        @error('file_materi') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
    </div>
    <div class="flex justify-end gap-2 pt-2" style="border-top:1px solid #E6D9C6;">
        <button type="button" onclick="tutupModalTambahMateri()" class="text-xs font-medium px-4 py-2 rounded-lg" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
        <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
            </svg>
            Unggah Materi
        </button>
    </div>
</form>
