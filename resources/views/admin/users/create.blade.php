<!-- Modal Tambah Akun Pengguna Baru -->
<div id="modal-overlay" class="fixed inset-0 z-40 items-center justify-center bg-black/40 backdrop-blur-[2px]">
    <div class="bg-white border border-[#E6D9C6] rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-[#F3EDE2]">
            <div>
                <h2 id="modal-title" class="font-display text-lg text-[#241508]">Tambah Pengguna</h2>
                <p class="text-[11px] text-[#8B6340] mt-0.5">Isi data akun baru dengan lengkap.</p>
            </div>
            <button type="button" onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#A87C52] hover:text-[#241508] hover:bg-[#F3EDE2] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="form-user" method="POST" action="#" class="px-6 py-5 space-y-4">
            @csrf
            <input type="hidden" id="modal-input-role" name="role" value="guru" />
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="modal-input-name" required placeholder="cth: Muhammad Saugi" class="form-input" />
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" id="modal-input-email" required placeholder="nama@sinau.test" class="form-input" />
            </div>
            <div>
                <label class="block text-xs font-medium text-[#4A2E1A] mb-1.5">Password Awal <span class="text-red-500">*</span></label>
                <input type="password" id="modal-input-password" required placeholder="Minimal 8 karakter" class="form-input" />
            </div>

            <!-- Actions -->
            <div class="flex gap-2 pt-2 border-t border-[#F3EDE2]">
                <button type="button" onclick="closeModal()" class="flex-1 text-sm font-medium bg-[#F3EDE2] text-[#6E4A2E] py-2.5 rounded-lg hover:bg-[#E6D9C6] transition-colors">
                    Batal
                </button>
                <button type="button" onclick="submitModal()" class="flex-1 text-sm font-semibold bg-[#4A2E1A] text-[#FAF8F4] py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
