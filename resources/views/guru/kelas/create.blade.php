<!-- Modal Tambah Kelas Baru -->
<div id="modal-tambah-kelas" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden" style="background:#FAF8F4;">
        <!-- Modal Header -->
        <div class="flex items-center justify-between px-6 py-5" style="background:#4A2E1A;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Tambah Kelas Baru</h2>
                <p class="text-xs mt-0.5" style="color:#A87C52;">Isi detail kelas yang akan Anda ampu.</p>
            </div>
            <button type="button" onclick="tutupModalTambahKelas()" class="w-8 h-8 flex items-center justify-center rounded-lg transition-colors" style="color:#D4C0A0; background:rgba(255,255,255,0.1);" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <form action="{{ route('guru.kelas.store') }}" method="POST" class="px-6 py-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" required placeholder="cth: XII IPA 4"
                        class="form-input @error('nama_kelas') border-red-400 @enderror" />
                    @error('nama_kelas') <p class="text-red-600 text-[11px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                    <select name="mata_pelajaran" class="form-input @error('mata_pelajaran') border-red-400 @enderror">
                        @foreach(['Matematika','Biologi','Fisika','Kimia','Bahasa Indonesia','Bahasa Inggris','Sejarah','Geografi','Ekonomi','Sosiologi','Informatika','Seni Budaya','PJOK','PPKn','Prakarya','Bahasa Asing'] as $mp)
                            <option value="{{ $mp }}" {{ old('mata_pelajaran') == $mp ? 'selected' : '' }}>{{ $mp }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Deskripsi / Jadwal <span class="text-[#8B6340] font-normal">(opsional)</span></label>
                <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="cth: Setiap Senin 08.00–09.30" class="form-input" />
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 pt-2" style="border-top:1px solid #E6D9C6;">
                <button type="button" onclick="tutupModalTambahKelas()" class="text-xs font-medium px-4 py-2 rounded-lg transition-colors" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg transition-colors" style="background:#4A2E1A; color:#FAF8F4;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Buat Kelas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalTambahKelas() {
    document.getElementById('modal-tambah-kelas').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function tutupModalTambahKelas() {
    document.getElementById('modal-tambah-kelas').classList.add('hidden');
    document.body.style.overflow = '';
}
// Close on backdrop click
document.getElementById('modal-tambah-kelas')?.addEventListener('click', function(e) {
    if (e.target === this) tutupModalTambahKelas();
});
// Auto-open if validation error
@if($errors->any() && old('_route') !== 'kelas.edit')
    document.addEventListener('DOMContentLoaded', () => bukaModalTambahKelas());
@endif
</script>
