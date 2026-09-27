<!-- Modal / Form Tambah Akun Pengguna Baru (Create Data) -->
<div id="modal-overlay" class="fixed inset-0 z-40 items-center justify-center bg-[#2C1A0E]/40 backdrop-blur-sm">
    <div class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-2xl shadow-xl w-full max-w-sm mx-4 p-7">
        <h2 id="modal-title" class="font-serif text-lg font-semibold text-[#2C1A0E] mb-5">Tambah Pengguna Baru</h2>
        
        <form id="form-user" method="POST" action="#">
            @csrf
            <div id="modal-body" class="space-y-3 mb-5">
                <div>
                    <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Nama Lengkap *</label>
                    <input type="text" id="modal-input-name" required placeholder="Contoh: Muhammad Saugi" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
                </div>
                <div>
                    <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Email *</label>
                    <input type="email" id="modal-input-email" required placeholder="nama@sinau.test" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
                </div>
                <div>
                    <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Role *</label>
                    <select id="modal-input-role" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]">
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
            </div>
            
            <div class="flex gap-2">
                <button type="button" onclick="closeModal()" class="flex-1 text-sm font-medium bg-[#EDE5D8] border border-[#D4C5A9] text-[#7A6050] py-2.5 rounded-xl hover:bg-[#D4C5A9] transition-colors">Batal</button>
                <button type="button" onclick="submitModal()" class="flex-1 text-sm font-semibold bg-[#7A5C3A] text-[#FAF7F2] py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors">Simpan</button>
            </div>
        </form>
    </div>
</div>
