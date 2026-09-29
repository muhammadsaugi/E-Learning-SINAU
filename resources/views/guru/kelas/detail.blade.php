<!-- Modal Detail Kelas -->
<div id="modal-detail-kelas" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px] hidden">
    <div class="bg-white border border-[#E6D9C6] rounded-2xl w-full max-w-lg shadow-2xl mx-4 overflow-hidden max-h-[90vh] flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-[#F3EDE2]">
            <div>
                <h3 class="font-display text-lg text-[#241508]" id="detail-nama-kelas">Detail Kelas</h3>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[11px] font-mono font-semibold px-2 py-0.5 rounded-md bg-[#F3EDE2] text-[#6E4A2E] border border-[#D4C0A0]" id="detail-kode-kelas">-</span>
                    <span class="text-[11px] text-[#8B6340]" id="detail-mapel">-</span>
                </div>
            </div>
            <button type="button" onclick="tutupModalDetailKelas()" class="w-8 h-8 flex items-center justify-center rounded-lg text-[#A87C52] hover:text-[#241508] hover:bg-[#F3EDE2] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">
            <!-- Info -->
            <div class="bg-[#FAF8F4] border border-[#F3EDE2] rounded-xl p-4 text-xs space-y-2">
                <div class="flex items-center gap-2 text-[#6E4A2E]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Pengampu: <strong class="text-[#241508]" id="detail-guru">-</strong></span>
                </div>
                <div class="text-[#6E4A2E]" id="detail-deskripsi-wrap">-</div>
            </div>

            <!-- Materi -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <h4 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider">Modul Materi</h4>
                    <span class="text-[10px] bg-[#F3EDE2] text-[#6E4A2E] px-2 py-0.5 rounded-full font-medium" id="detail-total-materi">0 modul</span>
                </div>
                <div id="detail-list-materi" class="space-y-1.5 text-xs text-[#6E4A2E]">
                    <p class="italic text-[#A87C52]">Memuat...</p>
                </div>
            </div>

            <!-- Kuis -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <h4 class="text-xs font-semibold text-[#4A2E1A] uppercase tracking-wider">Kuis & Evaluasi</h4>
                    <span class="text-[10px] bg-[#F3EDE2] text-[#6E4A2E] px-2 py-0.5 rounded-full font-medium" id="detail-total-kuis">0 kuis</span>
                </div>
                <div id="detail-list-kuis" class="space-y-1.5 text-xs text-[#6E4A2E]">
                    <p class="italic text-[#A87C52]">Memuat...</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-[#F3EDE2]">
            <button type="button" onclick="tutupModalDetailKelas()" class="w-full bg-[#4A2E1A] text-[#FAF8F4] text-xs font-semibold py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function bukaModalDetailKelas(data) {
    document.getElementById('detail-nama-kelas').textContent = data.nama_kelas || 'Kelas';
    document.getElementById('detail-mapel').textContent = data.mata_pelajaran || '-';
    document.getElementById('detail-kode-kelas').textContent = data.kode_kelas || '-';
    document.getElementById('detail-guru').textContent = data.guru ? data.guru.name : 'Guru SINAU';
    document.getElementById('detail-deskripsi-wrap').textContent = data.deskripsi || 'Tidak ada deskripsi.';

    const matContainer = document.getElementById('detail-list-materi');
    const matBadge = document.getElementById('detail-total-materi');
    if (data.materi && data.materi.length > 0) {
        matBadge.textContent = data.materi.length + ' modul';
        matContainer.innerHTML = data.materi.map(m => `
            <div class="flex items-center gap-2 px-3 py-2 bg-[#FAF8F4] border border-[#F3EDE2] rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#A87C52] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                </svg>
                <span class="font-medium text-[#241508]">${m.judul}</span>
            </div>`).join('');
    } else {
        matBadge.textContent = '0 modul';
        matContainer.innerHTML = '<p class="italic text-[#A87C52]">Belum ada materi untuk kelas ini.</p>';
    }

    const kuisContainer = document.getElementById('detail-list-kuis');
    const kuisBadge = document.getElementById('detail-total-kuis');
    if (data.kuis && data.kuis.length > 0) {
        kuisBadge.textContent = data.kuis.length + ' kuis';
        kuisContainer.innerHTML = data.kuis.map(k => `
            <div class="flex items-center justify-between px-3 py-2 bg-[#FAF8F4] border border-[#F3EDE2] rounded-lg">
                <span class="font-medium text-[#241508]">${k.judul}</span>
                <span class="text-[10px] text-[#8B6340]">KKM ${k.passing_grade} · ${k.durasi_menit} mnt</span>
            </div>`).join('');
    } else {
        kuisBadge.textContent = '0 kuis';
        kuisContainer.innerHTML = '<p class="italic text-[#A87C52]">Belum ada kuis untuk kelas ini.</p>';
    }

    document.getElementById('modal-detail-kelas').classList.remove('hidden');
}
function tutupModalDetailKelas() {
    document.getElementById('modal-detail-kelas').classList.add('hidden');
}
</script>
