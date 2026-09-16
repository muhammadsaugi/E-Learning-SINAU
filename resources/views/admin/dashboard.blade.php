@extends('layouts.app')

@section('title', 'SINAU — Admin')

@section('content')
<!-- Modal Tambah Data (Statis) -->
<div id="modal-overlay" class="fixed inset-0 z-40 items-center justify-center bg-[#2C1A0E]/40 backdrop-blur-sm">
    <div class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-2xl shadow-xl w-full max-w-sm mx-4 p-7">
        <h2 id="modal-title" class="font-serif text-lg font-semibold text-[#2C1A0E] mb-5">Tambah Baru</h2>
        <div id="modal-body" class="space-y-3 mb-5"></div>
        <div class="flex gap-2">
            <button onclick="closeModal()" class="flex-1 text-sm font-medium bg-[#EDE5D8] border border-[#D4C5A9] text-[#7A6050] py-2.5 rounded-xl hover:bg-[#D4C5A9] transition-colors">Batal</button>
            <button onclick="submitModal()" class="flex-1 text-sm font-semibold bg-[#7A5C3A] text-[#FAF7F2] py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors">Simpan</button>
        </div>
    </div>
</div>

<div class="flex h-screen overflow-hidden">

    <!-- Partial Sidebar Admin -->
    @include('partials.sidebar-admin')

    <!-- Konten Utama Admin -->
    <main class="flex-1 overflow-y-auto">
        <div class="max-w-4xl mx-auto px-8 py-8">

            <!-- ─── AKTIVITAS ─── -->
            <div id="tab-aktivitas" class="tab-content active">
                <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E] mb-1">Pantau Aktivitas Sistem</h1>
                <p class="text-sm text-[#7A6050] mb-7">Selamat datang, Administrator. Berikut kondisi platform hari ini.</p>

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-[#7A6050]">Total Siswa</p><span>🎓</span>
                        </div>
                        <p class="font-serif text-3xl font-bold text-[#2C1A0E]">69</p>
                        <p class="text-[10px] text-[#A67C52] mt-0.5">terdaftar aktif</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-[#7A6050]">Total Guru</p><span>👨‍🏫</span>
                        </div>
                        <p class="font-serif text-3xl font-bold text-[#2C1A0E]">4</p>
                        <p class="text-[10px] text-[#A67C52] mt-0.5">pengajar aktif</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-[#7A6050]">Kelas Aktif</p><span>🏫</span>
                        </div>
                        <p class="font-serif text-3xl font-bold text-[#2C1A0E]">6</p>
                        <p class="text-[10px] text-[#A67C52] mt-0.5">berjalan sekarang</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-[#7A6050]">Kuis Selesai</p><span>✎</span>
                        </div>
                        <p class="font-serif text-3xl font-bold text-[#2C1A0E]">412</p>
                        <p class="text-[10px] text-[#A67C52] mt-0.5">total pengerjaan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Aktivitas Terbaru -->
                    <div>
                        <h2 class="font-serif text-lg font-semibold text-[#2C1A0E] mb-4">Aktivitas Terbaru</h2>
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                            <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                                <span class="text-sm shrink-0 mt-0.5">🎓</span>
                                <p class="text-xs text-[#2C1A0E] flex-1">Citra Maharani menyelesaikan kuis Integral Tentu dengan nilai 95</p>
                                <span class="text-[10px] text-[#A67C52] shrink-0">5 mnt lalu</span>
                            </div>
                            <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                                <span class="text-sm shrink-0 mt-0.5">📚</span>
                                <p class="text-xs text-[#2C1A0E] flex-1">Pak Hendra mengunggah materi baru: Modul Substitusi Trigonometri</p>
                                <span class="text-[10px] text-[#A67C52] shrink-0">1 jam lalu</span>
                            </div>
                            <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                                <span class="text-sm shrink-0 mt-0.5">🏆</span>
                                <p class="text-xs text-[#2C1A0E] flex-1">3 siswa berhak mendapatkan sertifikat Biologi: Sistem Reproduksi</p>
                                <span class="text-[10px] text-[#A67C52] shrink-0">2 jam lalu</span>
                            </div>
                            <div class="flex items-start gap-3 px-4 py-3 border-b border-[#D4C5A9]">
                                <span class="text-sm shrink-0 mt-0.5">👨‍🏫</span>
                                <p class="text-xs text-[#2C1A0E] flex-1">Bu Sari memperbarui bank soal Kimia: Ikatan Kimia</p>
                                <span class="text-[10px] text-[#A67C52] shrink-0">5 jam lalu</span>
                            </div>
                            <div class="flex items-start gap-3 px-4 py-3">
                                <span class="text-sm shrink-0 mt-0.5">🎓</span>
                                <p class="text-xs text-[#2C1A0E] flex-1">12 siswa baru mendaftar ke kelas XII IPA 2</p>
                                <span class="text-[10px] text-[#A67C52] shrink-0">1 hari lalu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Distribusi Nilai -->
                    <div>
                        <h2 class="font-serif text-lg font-semibold text-[#2C1A0E] mb-4">Distribusi Nilai Siswa</h2>
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-xs text-[#7A6050] w-20 shrink-0">A (85–100)</span>
                                <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:55%"></div></div>
                                <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">38</span>
                            </div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-xs text-[#7A6050] w-20 shrink-0">B (70–84)</span>
                                <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:28%"></div></div>
                                <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">19</span>
                            </div>
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-xs text-[#7A6050] w-20 shrink-0">C (55–69)</span>
                                <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:12%"></div></div>
                                <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">8</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-[#7A6050] w-20 shrink-0">D (&lt;55)</span>
                                <div class="flex-1 h-2.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:6%"></div></div>
                                <span class="text-xs font-bold text-[#2C1A0E] w-5 text-right">4</span>
                            </div>
                            <div class="mt-5 pt-4 border-t border-[#D4C5A9] flex gap-2">
                                <button onclick="exportCSV()" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg hover:bg-[#5A3E28] transition-colors">⤓ Excel</button>
                                <button onclick="window.print()" class="text-xs font-semibold border border-[#D4C5A9] text-[#7A5C3A] px-3 py-1.5 rounded-lg hover:bg-[#D4C5A9] transition-colors">⤓ PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ─── KELOLA KELAS ─── -->
            <div id="tab-kelas" class="tab-content">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Kelola Daftar Kelas</h1>
                        <p class="text-sm text-[#7A6050]">Buat, edit, dan arsipkan kelas di platform.</p>
                    </div>
                    <button onclick="openModal('kelas')" class="text-sm font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors">+ Buat Kelas</button>
                </div>

                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                    <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
                        <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kelas</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Guru</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Siswa</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Progress</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Aksi</span>
                    </div>

                    <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
                        <div class="col-span-4">
                            <p class="text-sm font-medium text-[#2C1A0E]">Matematika: Integral Tentu</p>
                            <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#C4A882] text-[#2C1A0E]">Aktif</span>
                        </div>
                        <span class="col-span-2 text-xs text-[#7A6050]">Hendra</span>
                        <span class="col-span-2 text-sm text-[#2C1A0E] text-center">32</span>
                        <div class="col-span-2 flex flex-col items-center gap-1">
                            <span class="text-xs font-bold text-[#7A5C3A]">65%</span>
                            <div class="w-14 h-1.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:65%"></div></div>
                        </div>
                        <div class="col-span-2 flex justify-end gap-2">
                            <button onclick="openModal('kelas')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                            <button onclick="arsipKelas(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Arsip</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
                        <div class="col-span-4">
                            <p class="text-sm font-medium text-[#2C1A0E]">Biologi: Sistem Reproduksi</p>
                            <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Selesai</span>
                        </div>
                        <span class="col-span-2 text-xs text-[#7A6050]">Ratna</span>
                        <span class="col-span-2 text-sm text-[#2C1A0E] text-center">28</span>
                        <div class="col-span-2 flex flex-col items-center gap-1">
                            <span class="text-xs font-bold text-[#7A5C3A]">100%</span>
                            <div class="w-14 h-1.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:100%"></div></div>
                        </div>
                        <div class="col-span-2 flex justify-end gap-2">
                            <button onclick="openModal('kelas')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                            <button onclick="arsipKelas(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Arsip</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ─── AKUN GURU & SISWA ─── -->
            <div id="tab-akun" class="tab-content">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Kelola Akun Guru & Siswa</h1>
                        <p class="text-sm text-[#7A6050]">Tambah, edit, atau hapus akun pengguna platform.</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openModal('guru')" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors">+ Guru</button>
                        <button onclick="openModal('siswa')" class="text-xs font-semibold bg-[#C4A882] text-[#2C1A0E] px-4 py-2.5 rounded-xl hover:bg-[#B8956E] transition-colors">+ Siswa</button>
                    </div>
                </div>

                <!-- Daftar Guru -->
                <h2 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Guru</h2>
                <div id="guru-list" class="space-y-2 mb-7">
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold">HK</div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-medium text-[#2C1A0E]">Bapak Hendra Kurnia</p>
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Aktif</span>
                                </div>
                                <p class="text-xs text-[#7A6050]">Matematika · XII IPA 2, XII IPA 3</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="openModal('guru')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                            <button onclick="hapusRow(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Hapus</button>
                        </div>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold">RD</div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-medium text-[#2C1A0E]">Ibu Ratna Dewi</p>
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Aktif</span>
                                </div>
                                <p class="text-xs text-[#7A6050]">Biologi · XII IPA 1, XII IPA 2</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="openModal('guru')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                            <button onclick="hapusRow(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Hapus</button>
                        </div>
                    </div>
                </div>

                <!-- Daftar Siswa -->
                <h2 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Siswa</h2>
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                    <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
                        <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Nama</span>
                        <span class="col-span-3 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kelas</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Kuis</span>
                        <span class="col-span-1 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Nilai</span>
                        <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Aksi</span>
                    </div>
                    <div id="siswa-list">
                        <div class="grid grid-cols-12 px-5 py-3 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
                            <div class="col-span-4 flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[9px] font-semibold shrink-0">AK</div>
                                <p class="text-sm text-[#2C1A0E]">Arini Kusuma</p>
                            </div>
                            <span class="col-span-3 text-xs text-[#7A6050]">XII IPA 2</span>
                            <span class="col-span-2 text-xs text-[#2C1A0E] text-center">3/3</span>
                            <div class="col-span-1 flex justify-center">
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#7A5C3A]/15 text-[#7A5C3A]">92</span>
                            </div>
                            <div class="col-span-2 flex justify-end gap-2">
                                <button onclick="openModal('siswa')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                                <button onclick="hapusRow(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Hapus</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 px-5 py-3 items-center border-b border-[#D4C5A9] hover:bg-[#D4C5A9]/20 transition-colors">
                            <div class="col-span-4 flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[9px] font-semibold shrink-0">BP</div>
                                <p class="text-sm text-[#2C1A0E]">Bagas Pratama</p>
                            </div>
                            <span class="col-span-3 text-xs text-[#7A6050]">XII IPA 2</span>
                            <span class="col-span-2 text-xs text-[#2C1A0E] text-center">2/3</span>
                            <div class="col-span-1 flex justify-center">
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#C4A882]/40 text-[#5A3E28]">75</span>
                            </div>
                            <div class="col-span-2 flex justify-end gap-2">
                                <button onclick="openModal('siswa')" class="text-[10px] text-[#7A5C3A] hover:underline">Edit</button>
                                <button onclick="hapusRow(this)" class="text-[10px] text-[#C4A882] hover:text-[#A67C52]">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    const anavIds = ['aktivitas','kelas','akun'];
    let currentModal = null;

    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        anavIds.forEach(id => {
            const btn = document.getElementById('anav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#C4A882]');
        });
        document.getElementById('tab-' + tab).classList.add('active');
        const nav = document.getElementById('anav-' + tab);
        if (nav) { nav.classList.add('nav-active'); nav.classList.remove('text-[#C4A882]'); }
    }

    function openModal(type) {
        currentModal = type;
        const titles = { guru: 'Tambah Guru Baru', siswa: 'Tambah Siswa Baru', kelas: 'Buat Kelas Baru' };
        document.getElementById('modal-title').textContent = titles[type];
        const bodies = {
            guru: `<input placeholder="Nama Guru" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                   <input placeholder="Mata Pelajaran" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                   <input placeholder="Kelas (pisah koma)" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />`,
            siswa: `<input placeholder="Nama Siswa" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                    <input placeholder="Kelas (cth: XII IPA 2)" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />`,
            kelas: `<input placeholder="Nama Kelas / Mata Pelajaran" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                    <input placeholder="Nama Guru Pengampu" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                    <input type="number" placeholder="Jumlah Siswa" class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />`,
        };
        document.getElementById('modal-body').innerHTML = bodies[type];
        document.getElementById('modal-overlay').classList.add('open');
    }

    function closeModal() { document.getElementById('modal-overlay').classList.remove('open'); }

    function submitModal() {
        const msgs = { guru: 'Guru baru ditambahkan.', siswa: 'Siswa baru ditambahkan.', kelas: 'Kelas baru dibuat.' };
        showToast(msgs[currentModal] || 'Tersimpan.');
        closeModal();
    }

    function showToast(msg) {
        const t = document.getElementById('toast');
        t.textContent = '✓ ' + msg;
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 2500);
    }

    function hapusRow(btn) {
        btn.closest('.grid, .flex.items-center').remove();
        showToast('Data berhasil dihapus.');
    }

    function arsipKelas(btn) {
        const row = btn.closest('.grid');
        row.classList.toggle('opacity-50');
        btn.textContent = btn.textContent.trim() === 'Arsip' ? 'Aktifkan' : 'Arsip';
    }

    function exportCSV() {
        const csv = 'Nama,Kelas,Rata-rata\nArini Kusuma,XII IPA 2,92\nBagas Pratama,XII IPA 2,75\nCitra Maharani,XII IPA 1,88';
        const blob = new Blob([csv], {type:'text/csv'});
        const a = document.createElement('a'); a.href = URL.createObjectURL(blob);
        a.download = 'laporan-nilai.csv'; a.click();
    }
</script>
@endsection
