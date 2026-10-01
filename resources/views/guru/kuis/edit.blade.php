<!-- Modal Edit Kuis -->
<div id="modal-edit-kuis" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);">
    <div class="w-full max-w-lg mx-4 rounded-2xl shadow-2xl overflow-hidden" style="background:#FAF8F4;">
        <div class="flex items-center justify-between px-6 py-5" style="background:#6E4A2E;">
            <div>
                <h2 class="font-display text-lg" style="color:#FAF8F4;">Edit Kuis</h2>
                <p class="text-xs mt-0.5" style="color:#D4C0A0;">Perbarui informasi kuis.</p>
            </div>
            <button type="button" onclick="tutupModalEditKuis()" class="w-8 h-8 flex items-center justify-center rounded-lg" style="color:#D4C0A0; background:rgba(255,255,255,0.1);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
        <form id="form-edit-kuis" method="POST" class="px-6 py-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select id="edit-kuis-kelas" name="kelas_id" required class="form-input">
                    @if(isset($kelasList))
                        @foreach($kelasList as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Judul Kuis <span class="text-red-500">*</span></label>
                <input type="text" id="edit-kuis-judul" name="judul" required class="form-input" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">Durasi (menit)</label>
                    <input type="number" id="edit-kuis-durasi" name="durasi_menit" min="5" max="180" class="form-input" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-[#4A2E1A] mb-1.5">KKM / Passing Grade</label>
                    <input type="number" id="edit-kuis-passing" name="passing_grade" min="0" max="100" class="form-input" />
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-2" style="border-top:1px solid #E6D9C6;">
                <button type="button" onclick="tutupModalEditKuis()" class="text-xs font-medium px-4 py-2 rounded-lg" style="color:#6E4A2E; background:#EDE5D8; border:1px solid #D4C0A0;">Batal</button>
                <button type="submit" class="flex items-center gap-2 text-xs font-semibold px-5 py-2.5 rounded-lg" style="background:#4A2E1A; color:#FAF8F4;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
