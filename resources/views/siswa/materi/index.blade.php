<!-- ─── TAB MATERI SISWA ─── -->
<div id="tab-materi" class="tab-content">
    <div class="max-w-3xl mx-auto px-7 py-7">

        <div class="mb-6">
            <h1 class="font-display text-2xl text-[#241508]">Materi Pembelajaran</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Unduh modul dan pelajari topik yang diberikan oleh guru.</p>
        </div>

        <!-- Daftar Materi -->
        <div class="space-y-3 mb-8">
            @if(isset($materiList) && $materiList->count() > 0)
                @foreach($materiList as $materi)
                    <div class="data-card bg-white border border-[#E6D9C6] rounded-xl p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3.5 min-w-0">
                                <div class="w-10 h-10 bg-[#F3EDE2] border border-[#E6D9C6] rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="text-[10px] font-semibold text-[#6E4A2E] bg-[#F3EDE2] border border-[#D4C0A0] px-2 py-0.5 rounded-md">{{ $materi->kelas->nama_kelas ?? 'Umum' }}</span>
                                        <span class="text-[11px] text-[#A87C52]">{{ $materi->kelas->mata_pelajaran ?? '' }} · {{ $materi->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h3 class="font-semibold text-[#241508] text-sm">{{ $materi->judul }}</h3>
                                    @if($materi->deskripsi)
                                        <p class="text-[11px] text-[#6E4A2E] mt-1 leading-relaxed">{{ $materi->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="shrink-0 flex flex-col items-end gap-2">
                                @if($materi->file_path)
                                    <a href="{{ route('materi.download', $materi->id) }}" class="flex items-center gap-1.5 text-xs font-semibold text-[#FAF8F4] bg-[#4A2E1A] hover:bg-[#241508] px-3.5 py-2 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
                                        </svg>
                                        Unduh
                                    </a>
                                @else
                                    <span class="text-[11px] text-[#A87C52] bg-[#F3EDE2] px-2.5 py-1 rounded-lg border border-[#E6D9C6]">Materi Teks</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-[#E6D9C6] rounded-xl px-6 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A]">Belum ada materi</p>
                    <p class="text-xs text-[#8B6340] mt-1">Guru belum mengunggah materi pembelajaran.</p>
                </div>
            @endif
        </div>

        <!-- Forum Diskusi -->
        <div class="mb-5">
            <h2 class="text-sm font-semibold text-[#241508] mb-4">Forum Diskusi</h2>
            <form onsubmit="submitComment(event)" class="mb-5">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] font-semibold text-xs shrink-0 mt-0.5">
                        {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <textarea id="comment-input" placeholder="Tanyakan kepada guru terkait materi..." rows="2"
                            class="w-full bg-[#FAF8F4] border border-[#E6D9C6] rounded-xl px-4 py-3 text-sm text-[#241508] placeholder-[#A87C52] resize-none focus:outline-none focus:border-[#8B6340]"></textarea>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="flex items-center gap-1.5 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-4 py-2 rounded-lg hover:bg-[#241508] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                                Kirim
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="comment-list" class="space-y-3">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] font-semibold text-xs shrink-0 mt-0.5">AK</div>
                    <div class="flex-1">
                        <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-3">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-semibold text-[#241508]">Arini Kusuma</span>
                                <span class="text-[11px] text-[#A87C52]">2 jam lalu</span>
                            </div>
                            <p class="text-sm text-[#4A2E1A]">Materi modul sangat jelas dan mudah dipahami, terima kasih!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
