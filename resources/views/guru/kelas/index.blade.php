<!-- ─── TAB KELOLA KELAS ─── -->
<div id="tab-kelas" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Buat & Kelola Kelas</h2>
    <p class="text-sm text-[#7A6050] mb-5">Atur kelas yang kamu ampu, jadwal, dan status aktifnya.</p>
    
    <!-- Daftar Kelas Dinamis dari Database -->
    <div class="space-y-3 mb-6">
        @if(isset($kelasList) && $kelasList->count() > 0)
            @foreach($kelasList as $kelas)
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <p class="text-sm font-semibold text-[#2C1A0E]">{{ $kelas->nama_kelas }}</p>
                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Kode: {{ $kelas->kode_kelas }}</span>
                            </div>
                            <p class="text-xs text-[#7A6050]">{{ $kelas->mata_pelajaran }}</p>
                            @if($kelas->deskripsi)
                                <p class="text-xs text-[#A67C52] mt-0.5">📝 {{ $kelas->deskripsi }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('guru.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-medium text-red-700 hover:text-red-900 px-2 py-1.5 rounded-lg border border-red-300 hover:bg-red-50 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-6 text-center">
                <p class="text-xs text-[#7A6050] italic">Belum ada kelas yang dibuat. Silakan buat kelas baru di bawah.</p>
            </div>
        @endif
    </div>

    <!-- Partial Form Tambah Kelas -->
    @include('guru.kelas.create')
</div>
