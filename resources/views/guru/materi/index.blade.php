<!-- ─── TAB UNGGAH MATERI ─── -->
<div id="tab-materi" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Unggah Materi Pembelajaran</h2>
    <p class="text-sm text-[#7A6050] mb-5">Unggah dokumen materi (PDF atau Dokumen) untuk diakses oleh siswa.</p>
    
    <!-- Partial Form Tambah Materi -->
    @include('guru.materi.create')

    <!-- Daftar Materi Tersimpan -->
    <h3 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Materi Tersimpan</h3>
    <div class="space-y-2">
        @if(isset($materiList) && $materiList->count() > 0)
            @foreach($materiList as $mat)
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📄</span>
                        <div>
                            <p class="text-sm font-semibold text-[#2C1A0E]">{{ $mat->judul }}</p>
                            <p class="text-xs text-[#7A6050]">Kelas: {{ $mat->kelas->nama_kelas ?? 'Umum' }} · {{ $mat->created_at->format('d M Y') }}</p>
                            @if($mat->deskripsi)
                                <p class="text-xs text-[#A67C52] mt-0.5">📌 {{ $mat->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($mat->file_path)
                            <a href="{{ route('materi.download', $mat->id) }}" class="text-xs font-semibold text-[#7A5C3A] hover:text-[#5A3E28] px-2.5 py-1 border border-[#D4C5A9] rounded-lg bg-[#FAF7F2] transition-colors">
                                ⤓ Unduh
                            </a>
                        @endif
                        <form action="{{ route('guru.materi.destroy', $mat->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-700 hover:text-red-900 px-2 py-1 border border-red-300 rounded hover:bg-red-50">✕ Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-5 text-center text-xs text-[#7A6050] italic">
                Belum ada berkas materi. Silakan unggah materi pertama Anda di atas.
            </div>
        @endif
    </div>
</div>
