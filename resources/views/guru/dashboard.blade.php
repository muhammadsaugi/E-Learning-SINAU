@extends('layouts.app')

@section('title', 'SINAU — Guru')

@section('content')
<div class="flex flex-col h-screen overflow-hidden">

    <!-- Partial Topbar Header -->
    @include('partials.topbar', ['roleTitle' => 'Mode Guru'])

    <div class="flex flex-1 overflow-hidden">

        <!-- Partial Sidebar Guru -->
        @include('partials.sidebar-guru')

        <!-- Konten Utama Guru -->
        <main class="flex-1 overflow-y-auto">
            <div class="max-w-3xl mx-auto px-7 py-7">

                <!-- Stats (selalu tampil) -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-7">
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Total Siswa</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">8</p>
                        <p class="text-[10px] text-[#A67C52]">terdaftar</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Rata-rata Kelas</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">79</p>
                        <p class="text-[10px] text-[#A67C52]">dari 100</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Siswa Lulus</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">6</p>
                        <p class="text-[10px] text-[#A67C52]">≥70 rata-rata</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Kuis Aktif</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">3</p>
                        <p class="text-[10px] text-[#A67C52]">topik</p>
                    </div>
                </div>

                <!-- ─── REKAP NILAI ─── -->
                <div id="tab-nilai" class="tab-content active">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-4">Rekap Nilai Siswa</h2>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
                            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Siswa</span>
                            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Kuis</span>
                            <span class="col-span-3 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Rata-rata</span>
                            <span class="col-span-1 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Grade</span>
                            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Detail</span>
                        </div>

                        <div class="grid grid-cols-12 px-5 py-3.5 items-center border-b border-[#D4C5A9] cursor-pointer hover:bg-[#D4C5A9]/30 transition-colors">
                            <div class="col-span-4 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[10px] font-semibold shrink-0">AK</div>
                                <p class="text-sm font-medium text-[#2C1A0E]">Arini Kusuma</p>
                            </div>
                            <div class="col-span-2 text-center text-xs text-[#2C1A0E]">3/3</div>
                            <div class="col-span-3 flex flex-col items-center gap-1">
                                <span class="text-sm font-bold text-[#2C1A0E]">92</span>
                                <div class="w-14 h-1.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:92%"></div></div>
                            </div>
                            <div class="col-span-1 flex justify-center"><span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#7A5C3A]/15 text-[#7A5C3A]">A</span></div>
                            <div class="col-span-2 flex justify-end text-xs text-[#A67C52]">▼</div>
                        </div>

                        <div class="grid grid-cols-12 px-5 py-3.5 items-center border-b border-[#D4C5A9] cursor-pointer hover:bg-[#D4C5A9]/30 transition-colors">
                            <div class="col-span-4 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[10px] font-semibold shrink-0">BP</div>
                                <p class="text-sm font-medium text-[#2C1A0E]">Bagas Pratama</p>
                            </div>
                            <div class="col-span-2 text-center text-xs text-[#2C1A0E]">2/3</div>
                            <div class="col-span-3 flex flex-col items-center gap-1">
                                <span class="text-sm font-bold text-[#2C1A0E]">75</span>
                                <div class="w-14 h-1.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:75%"></div></div>
                            </div>
                            <div class="col-span-1 flex justify-center"><span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#C4A882]/40 text-[#5A3E28]">B</span></div>
                            <div class="col-span-2 flex justify-end text-xs text-[#A67C52]">▼</div>
                        </div>

                        <div class="grid grid-cols-12 px-5 py-3.5 items-center cursor-pointer hover:bg-[#D4C5A9]/30 transition-colors">
                            <div class="col-span-4 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-[10px] font-semibold shrink-0">CM</div>
                                <p class="text-sm font-medium text-[#2C1A0E]">Citra Maharani</p>
                            </div>
                            <div class="col-span-2 text-center text-xs text-[#2C1A0E]">3/3</div>
                            <div class="col-span-3 flex flex-col items-center gap-1">
                                <span class="text-sm font-bold text-[#2C1A0E]">88</span>
                                <div class="w-14 h-1.5 bg-[#D4C5A9] rounded-full"><div class="h-full bg-[#7A5C3A] rounded-full" style="width:88%"></div></div>
                            </div>
                            <div class="col-span-1 flex justify-center"><span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#7A5C3A]/15 text-[#7A5C3A]">A</span></div>
                            <div class="col-span-2 flex justify-end text-xs text-[#A67C52]">▼</div>
                        </div>
                    </div>
                </div>

                <!-- ─── IZIN PEMBAHASAN ─── -->
                <div id="tab-izin" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Izin Pembahasan Jawaban</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Aktifkan untuk membolehkan siswa melihat jawaban benar/salah.</p>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl overflow-hidden">
                        <div class="grid grid-cols-12 px-5 py-3 bg-[#D4C5A9]/50 border-b border-[#D4C5A9]">
                            <span class="col-span-6 text-xs font-semibold text-[#7A6050] uppercase tracking-wider">Kuis</span>
                            <span class="col-span-2 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-center">Peserta</span>
                            <span class="col-span-4 text-xs font-semibold text-[#7A6050] uppercase tracking-wider text-right">Izin</span>
                        </div>
                        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9]">
                            <div class="col-span-6">
                                <p class="text-sm font-medium text-[#2C1A0E]">Quiz: Integral Tentu</p>
                                <p class="text-xs text-[#7A6050]">Matematika · 12 Jan 2025</p>
                            </div>
                            <div class="col-span-2 text-center text-sm text-[#2C1A0E]">8</div>
                            <div class="col-span-4 flex items-center justify-end gap-3">
                                <span class="text-xs font-medium text-[#A67C52]" id="label-q1">✗ Tutup</span>
                                <button onclick="togglePermission('q1', this)" class="relative w-11 h-6 rounded-full bg-[#D4C5A9] transition-colors duration-200 shrink-0">
                                    <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow transition-all duration-200"></span>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#D4C5A9]">
                            <div class="col-span-6">
                                <p class="text-sm font-medium text-[#2C1A0E]">Quiz: Sistem Reproduksi</p>
                                <p class="text-xs text-[#7A6050]">Biologi · 5 Jan 2025</p>
                            </div>
                            <div class="col-span-2 text-center text-sm text-[#2C1A0E]">8</div>
                            <div class="col-span-4 flex items-center justify-end gap-3">
                                <span class="text-xs font-medium text-[#7A5C3A]" id="label-q2">✓ Buka</span>
                                <button onclick="togglePermission('q2', this)" class="relative w-11 h-6 rounded-full bg-[#7A5C3A] transition-colors duration-200 shrink-0">
                                    <span class="absolute top-0.5 left-5 w-5 h-5 rounded-full bg-white shadow transition-all duration-200"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ─── SERTIFIKAT ─── -->
                <div id="tab-sertifikat" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Terbitkan Sertifikat</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Siswa yang memenuhi syarat: semua kuis dengan rata-rata ≥70.</p>
                    <div class="space-y-3">
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold">AK</div>
                                <div>
                                    <p class="text-sm font-semibold text-[#2C1A0E]">Arini Kusuma</p>
                                    <p class="text-xs text-[#7A6050]">Rata-rata: <span class="text-[#7A5C3A] font-bold">92</span> · 3/3 kuis selesai</p>
                                </div>
                            </div>
                            <button onclick="this.textContent = this.textContent.trim() === '🏆 Terbitkan' ? '✓ Cabut Sertifikat' : '🏆 Terbitkan'"
                                class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">
                                🏆 Terbitkan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ─── NILAI ESAI ─── -->
                <div id="tab-esai" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Nilai Ujian Esai</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Berikan nilai untuk jawaban esai yang dikumpulkan siswa.</p>
                    <div class="space-y-3">
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-3 flex-1">
                                    <div class="w-8 h-8 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] text-xs font-semibold shrink-0 mt-0.5">AK</div>
                                    <div>
                                        <p class="text-sm font-semibold text-[#2C1A0E]">Arini Kusuma</p>
                                        <p class="text-xs text-[#7A6050] mb-1">Matematika · Dikumpulkan 10 Jan 2025</p>
                                        <p class="text-xs text-[#3D2314] italic">"Analisis Penerapan Integral dalam Kehidupan Nyata"</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <input type="number" min="0" max="100" placeholder="0–100"
                                        onkeydown="if(event.key==='Enter') simpanNilai(this)"
                                        class="w-20 bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-1.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52] text-center" />
                                    <button onclick="simpanNilai(this.previousElementSibling)"
                                        class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg hover:bg-[#5A3E28] transition-colors">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ─── BANK SOAL ─── -->
                <div id="tab-banksoal" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Bank Soal & Kuis</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Kelola kumpulan soal untuk kuis dan evaluasi.</p>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 mb-5">
                        <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Tambah Soal Baru</p>
                        <textarea id="new-soal" placeholder="Tulis pertanyaan di sini..." rows="2"
                            class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-4 py-3 text-sm text-[#2C1A0E] resize-none focus:outline-none focus:border-[#A67C52] mb-3"></textarea>
                        <div class="flex items-center gap-3">
                            <select class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none">
                                <option>Matematika</option><option>Biologi</option><option>Fisika</option><option>Kimia</option>
                            </select>
                            <select class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-xs text-[#2C1A0E] focus:outline-none">
                                <option>PG</option><option>Esai</option><option>Benar/Salah</option>
                            </select>
                            <button onclick="tambahSoal()" class="ml-auto text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">+ Tambah Soal</button>
                        </div>
                    </div>
                    <div id="soal-list" class="space-y-2">
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <span class="text-xs font-bold text-[#A67C52] mt-0.5 shrink-0">#1</span>
                                <p class="text-sm text-[#2C1A0E]">Manakah dari pernyataan berikut yang BENAR mengenai integral tentu?</p>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="text-[10px] bg-[#D4C5A9] text-[#5A3E28] px-2 py-0.5 rounded-full font-medium">Matematika</span>
                                <span class="text-[10px] bg-[#C4A882] text-[#2C1A0E] px-2 py-0.5 rounded-full font-medium">PG</span>
                                <button onclick="this.closest('.bg-\\[\\#EDE5D8\\]').remove()" class="text-[10px] text-[#C4A882] hover:text-[#7A5C3A] ml-1">✕</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ─── UNGGAH MATERI (PDF/Word, maks 20MB) ─── -->
                <div id="tab-materi" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Unggah Materi Pembelajaran</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Unggah dokumen materi (PDF atau Word) untuk diakses siswa.</p>
                    <div class="border-2 border-dashed border-[#C4A882] bg-[#EDE5D8] rounded-xl p-8 text-center mb-6">
                        <div class="text-3xl mb-2">📂</div>
                        <p class="text-sm font-medium text-[#2C1A0E]">Seret file ke sini atau</p>
                        <label class="cursor-pointer">
                            <span class="text-xs font-semibold text-[#7A5C3A] underline">pilih dari komputer</span>
                            <input type="file" multiple accept=".pdf,.doc,.docx" class="hidden" />
                        </label>
                        <p class="text-[10px] text-[#A67C52] mt-1">PDF atau Word (DOC/DOCX), hingga 20MB</p>
                    </div>
                    <h3 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Materi Tersimpan</h3>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-center justify-between mb-2">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">📄</span>
                            <div>
                                <p class="text-sm font-medium text-[#2C1A0E]">Modul Integral Tentu Bab 7.pdf</p>
                                <p class="text-xs text-[#7A6050]">Matematika · 2.4 MB · 12 Jan 2025</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="#" class="text-xs text-[#7A5C3A] hover:text-[#5A3E28] font-medium">⤓ Unduh</a>
                            <button class="text-xs text-[#C4A882] hover:text-[#A67C52]">✕</button>
                        </div>
                    </div>
                </div>

                <!-- ─── KELOLA KELAS ─── -->
                <div id="tab-kelas" class="tab-content">
                    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Buat & Kelola Kelas</h2>
                    <p class="text-sm text-[#7A6050] mb-5">Atur kelas yang kamu ampu, jadwal, dan status aktifnya.</p>
                    <div class="space-y-3 mb-6">
                        <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <p class="text-sm font-semibold text-[#2C1A0E]">XII IPA 2</p>
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-[#7A5C3A] text-[#FAF7F2]">Aktif</span>
                                    </div>
                                    <p class="text-xs text-[#7A6050]">Matematika · 32 siswa</p>
                                    <p class="text-xs text-[#A67C52] mt-0.5">⏰ Senin 08.00–09.30</p>
                                </div>
                                <div class="flex gap-2">
                                    <button class="text-xs font-medium bg-[#D4C5A9] text-[#5A3E28] px-3 py-1.5 rounded-lg hover:bg-[#C4A882] transition-colors">Edit</button>
                                    <button class="text-xs font-medium text-[#C4A882] hover:text-[#A67C52] px-2 py-1.5">✕</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Buat Kelas Baru -->
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5">
                        <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-4">Buat Kelas Baru</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Nama Kelas</label>
                                <input type="text" placeholder="Contoh: XII IPA 4" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                            </div>
                            <div>
                                <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Mata Pelajaran</label>
                                <select class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none">
                                    <option>Matematika</option><option>Biologi</option><option>Fisika</option><option>Kimia</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Jadwal</label>
                                <input type="text" placeholder="Senin 08.00–09.30" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                            </div>
                            <div>
                                <label class="text-[10px] text-[#7A6050] font-medium mb-1 block">Kapasitas Siswa</label>
                                <input type="number" placeholder="32" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-2 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#A67C52]" />
                            </div>
                        </div>
                        <button class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-5 py-2.5 rounded-lg hover:bg-[#5A3E28] transition-colors">+ Buat Kelas</button>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const gnavIds = ['nilai','izin','sertifikat','esai','banksoal','materi','kelas'];

    function showTab(tab) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        gnavIds.forEach(id => {
            const btn = document.getElementById('gnav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#5A3E28]');
            btn.classList.remove('text-[#FAF7F2]');
        });
        document.getElementById('tab-' + tab).classList.add('active');
        const nav = document.getElementById('gnav-' + tab);
        if (nav) { nav.classList.add('nav-active'); nav.classList.remove('text-[#5A3E28]'); }
    }

    function togglePermission(id, btn) {
        const isOn = btn.classList.contains('bg-[#7A5C3A]');
        const label = document.getElementById('label-' + id);
        if (isOn) {
            btn.classList.replace('bg-[#7A5C3A]', 'bg-[#D4C5A9]');
            btn.querySelector('span').classList.replace('left-5', 'left-0.5');
            label.textContent = '✗ Tutup'; label.className = 'text-xs font-medium text-[#A67C52]';
        } else {
            btn.classList.replace('bg-[#D4C5A9]', 'bg-[#7A5C3A]');
            btn.querySelector('span').classList.replace('left-0.5', 'left-5');
            label.textContent = '✓ Buka'; label.className = 'text-xs font-medium text-[#7A5C3A]';
        }
    }

    function simpanNilai(input) {
        const val = parseInt(input.value);
        if (isNaN(val) || val < 0 || val > 100) return;
        const wrapper = input.closest('.flex.items-center.gap-2');
        wrapper.innerHTML = `<span class="text-lg font-bold text-[#7A5C3A]">${val}</span>
            <span class="text-[11px] font-bold px-1.5 py-0.5 rounded bg-[#7A5C3A]/15 text-[#7A5C3A]">${val >= 85 ? 'A' : val >= 70 ? 'B' : val >= 55 ? 'C' : 'D'}</span>
            <button onclick="this.parentElement.innerHTML='<input type=number class=\\'w-20 bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-1.5 text-sm text-center focus:outline-none\\' /><button onclick=\\'simpanNilai(this.previousElementSibling)\\' class=\\'text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg\\'>Simpan</button>'" class="text-[10px] text-[#A67C52] hover:text-[#7A5C3A]">Ubah</button>`;
    }

    function tambahSoal() {
        const soal = document.getElementById('new-soal').value.trim();
        if (!soal) return;
        const count = document.querySelectorAll('#soal-list > div').length + 1;
        const div = document.createElement('div');
        div.className = 'bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-3.5 flex items-start justify-between gap-4';
        div.innerHTML = `<div class="flex items-start gap-3"><span class="text-xs font-bold text-[#A67C52] mt-0.5 shrink-0">#${count}</span><p class="text-sm text-[#2C1A0E]">${soal}</p></div>
            <div class="flex items-center gap-2 shrink-0"><span class="text-[10px] bg-[#D4C5A9] text-[#5A3E28] px-2 py-0.5 rounded-full font-medium">Matematika</span><button onclick="this.closest('.bg-\\\\[\\\\#EDE5D8\\\\]').remove()" class="text-[10px] text-[#C4A882] hover:text-[#7A5C3A] ml-1">✕</button></div>`;
        document.getElementById('soal-list').appendChild(div);
        document.getElementById('new-soal').value = '';
    }
</script>
@endsection
