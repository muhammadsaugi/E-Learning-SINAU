<!-- ─── TAB MATERI SISWA (Dinamis dari Database) ─── -->
<div id="tab-materi" class="tab-content">
    <div class="max-w-3xl mx-auto px-8 py-8">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Materi Pembelajaran</h1>
            <p class="text-sm text-[#7A6050] mt-1">Unduh modul dan pelajari topik pembelajaran yang diberikan guru.</p>
        </div>

        <!-- Daftar Berkas Materi dari Guru -->
        <div class="space-y-4 mb-8">
            @if(isset($materiList) && $materiList->count() > 0)
                @foreach($materiList as $materi)
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 hover:border-[#C4A882] transition-all">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-12 h-12 bg-[#D4C5A9] rounded-xl flex items-center justify-center text-2xl shrink-0 mt-0.5">
                                    📄
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[10px] font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-2 py-0.5 rounded-full">
                                            {{ $materi->kelas->nama_kelas ?? 'Kelas Umum' }}
                                        </span>
                                        <span class="text-xs text-[#7A6050]">
                                            {{ $materi->kelas->mata_pelajaran ?? 'Pelajaran' }} · Diunggah {{ $materi->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h3 class="font-serif text-lg font-semibold text-[#2C1A0E]">{{ $materi->judul }}</h3>
                                    @if($materi->deskripsi)
                                        <p class="text-xs text-[#3D2314] mt-1.5 leading-relaxed">{{ $materi->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="shrink-0 flex flex-col items-end gap-2">
                                @if($materi->file_path)
                                    <a href="{{ route('materi.download', $materi->id) }}" class="text-xs font-semibold text-[#FAF7F2] bg-[#7A5C3A] hover:bg-[#5A3E28] px-3.5 py-2 rounded-lg transition-colors flex items-center gap-1.5 shadow-sm">
                                        <span>⤓</span> Unduh Berkas
                                    </a>
                                @else
                                    <span class="text-[11px] text-[#A67C52] bg-[#D4C5A9]/50 px-2.5 py-1 rounded-md">Materi Teks</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-8 text-center text-xs text-[#7A6050] italic">
                    Belum ada materi pembelajaran yang diunggah oleh guru.
                </div>
            @endif
        </div>

        <!-- Diskusi & Tanya Jawab -->
        <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-4">Forum Diskusi</h2>
        <form onsubmit="submitComment(event)" class="mb-6">
            <div class="flex gap-3">
                <div class="w-9 h-9 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] font-semibold text-xs shrink-0 mt-0.5">Siswa</div>
                <div class="flex-1">
                    <textarea id="comment-input" placeholder="Tanyakan pertanyaan terkait materi kepada guru..." rows="2"
                        class="w-full bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3 text-sm text-[#2C1A0E] placeholder-[#A67C52] resize-none focus:outline-none focus:border-[#7A5C3A]"></textarea>
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2 rounded-lg hover:bg-[#5A3E28] transition-colors">Kirim Pertanyaan</button>
                    </div>
                </div>
            </div>
        </form>

        <div id="comment-list" class="space-y-3">
            <div class="flex gap-3">
                <div class="w-9 h-9 rounded-full bg-[#D4C5A9] flex items-center justify-center text-[#2C1A0E] font-semibold text-xs shrink-0 mt-0.5">AK</div>
                <div class="flex-1">
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-[#2C1A0E]">Arini Kusuma</span>
                            <span class="text-xs text-[#7A6050]">2 jam lalu</span>
                        </div>
                        <p class="text-sm text-[#3D2314]">Materi modul sangat jelas dan mudah dipahami, terima kasih!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
