<!-- Modal Edit Kelas -->
<div id="modal-edit-kelas" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px] hidden">
    <div class="bg-white border border-[#E6D9C6] rounded-2xl p-6 w-full max-w-lg shadow-2xl mx-4">
        <div class="flex items-center justify-between pb-4 border-b border-[#F3EDE2] mb-5">
            <div>
                <h3 class="font-display text-lg text-[#241508]">Edit Kelas</h3>
                <p class="text-xs text-[#8B6340] mt-0.5">Perbarui informasi kelas yang dipilih.</p>
            </div>
            <button type="button" onclick="tutupModalEditKelas()" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#A87C52] hover:text-[#241508] hover:bg-[#F3EDE2] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <form id="form-edit-kelas" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Nama Kelas <span class="text-red-500">*</span></label>
                <input type="text" id="edit-nama-kelas" name="nama_kelas" required class="form-input" />
            </div>

            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                <select id="edit-mata-pelajaran" name="mata_pelajaran" required class="form-input">
                    @foreach(['Matematika','Biologi','Fisika','Kimia','Bahasa Indonesia','Bahasa Inggris','Sejarah','Geografi','Ekonomi','Sosiologi','Informatika','Seni Budaya','PJOK','PPKn','Prakarya','Bahasa Asing'] as $mp)
                        <option value="{{ $mp }}">{{ $mp }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Deskripsi / Jadwal <span class="text-[#A87C52] font-normal">(opsional)</span></label>
                <textarea id="edit-deskripsi" name="deskripsi" rows="2" class="form-input resize-none"></textarea>
            </div>

            <div class="pt-4 border-t border-[#F3EDE2] flex items-center justify-end gap-2">
                <button type="button" onclick="tutupModalEditKelas()" class="text-xs text-[#8B6340] hover:text-[#4A2E1A] px-4 py-2 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex items-center gap-2 bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalEditKelas(kelas) {
    document.getElementById('form-edit-kelas').action = `/guru/kelas/${kelas.id}`;
    document.getElementById('edit-nama-kelas').value = kelas.nama_kelas || '';
    document.getElementById('edit-mata-pelajaran').value = kelas.mata_pelajaran || '';
    document.getElementById('edit-deskripsi').value = kelas.deskripsi || '';
    document.getElementById('modal-edit-kelas').classList.remove('hidden');
}
function tutupModalEditKelas() {
    document.getElementById('modal-edit-kelas').classList.add('hidden');
}
</script>
