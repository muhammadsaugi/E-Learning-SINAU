<!-- ─── TAB KUIS SISWA ─── -->
<div id="tab-quiz" class="tab-content">
    <div class="max-w-3xl mx-auto px-7 py-7">
        <div class="mb-6">
            <h1 class="font-display text-2xl text-[#241508]">Evaluasi & Kuis</h1>
            <p class="text-sm text-[#8B6340] mt-0.5">Uji pemahaman Anda dengan soal pilihan ganda dan esai dari guru.</p>
        </div>

        <div class="space-y-4">
            @if(isset($kuisList) && $kuisList->count() > 0)
                @foreach($kuisList as $kuis)
                    @php
                        $hasilNilai = isset($nilaiList) ? $nilaiList->where('kuis_id', $kuis->id)->first() : null;
                    @endphp

                    <div class="data-card bg-white border {{ $hasilNilai ? 'border-[#8B6340]/30' : 'border-[#E6D9C6]' }} rounded-xl overflow-hidden">
                        <!-- Info Kuis -->
                        <div class="px-5 py-4 flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3.5 min-w-0">
                                <div class="w-10 h-10 {{ $hasilNilai ? 'bg-[#4A2E1A]' : 'bg-[#F3EDE2]' }} rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                                    @if($hasilNilai)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#8B6340]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="text-[10px] font-semibold text-[#6E4A2E] bg-[#F3EDE2] border border-[#D4C0A0] px-2 py-0.5 rounded-md">{{ $kuis->kelas->nama_kelas ?? 'Umum' }}</span>
                                        @if($hasilNilai)
                                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-md {{ $hasilNilai->status === 'lulus' ? 'bg-[#e8f5e9] text-[#2e7d32] border border-[#a5d6a7]' : 'bg-[#fce4ec] text-[#c62828] border border-[#ef9a9a]' }}">
                                                {{ $hasilNilai->status === 'lulus' ? 'Lulus' : 'Di Bawah KKM' }} · {{ $hasilNilai->nilai }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-semibold text-[#241508] text-sm mb-1.5">{{ $kuis->judul }}</h3>
                                    <div class="flex items-center gap-4 text-[11px] text-[#A87C52]">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                            </svg>
                                            {{ $kuis->durasi_menit }} menit
                                        </span>
                                        <span>KKM {{ $kuis->passing_grade }}</span>
                                        <span>{{ $kuis->soal->count() }} soal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0">
                                @if($kuis->soal->count() > 0)
                                    <button onclick="bukaUjian({{ $kuis->id }})"
                                        class="flex items-center gap-2 text-xs font-semibold {{ $hasilNilai ? 'border border-[#D4C0A0] text-[#4A2E1A] bg-[#FAF8F4] hover:bg-[#F3EDE2]' : 'bg-[#4A2E1A] text-[#FAF8F4] hover:bg-[#241508]' }} px-4 py-2 rounded-lg transition-colors">
                                        @if(!$hasilNilai)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polygon points="5 3 19 12 5 21 5 3"/>
                                            </svg>
                                        @endif
                                        {{ $hasilNilai ? 'Kerjakan Ulang' : 'Mulai' }}
                                    </button>
                                @else
                                    <span class="text-xs text-[#A87C52] bg-[#F3EDE2] px-3 py-2 rounded-lg border border-[#E6D9C6]">Soal Belum Ada</span>
                                @endif
                            </div>
                        </div>

                        <!-- Lembar Pengerjaan -->
                        @if($kuis->soal->count() > 0)
                            <div id="lembar-ujian-{{ $kuis->id }}" class="hidden border-t border-[#F3EDE2]">
                                <div class="px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
                                    <p class="text-[11px] font-semibold text-[#4A2E1A] uppercase tracking-wider">Lembar Pengerjaan</p>
                                    <p class="text-[11px] text-[#8B6340]">Pilih atau ketikkan jawaban yang paling tepat.</p>
                                </div>
                                <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST" class="px-5 py-5 space-y-4">
                                    @csrf
                                    @foreach($kuis->soal as $idx => $s)
                                        <div class="bg-[#FAF8F4] border border-[#F3EDE2] rounded-xl p-4">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-[11px] font-semibold text-[#8B6340]">Soal {{ $idx + 1 }}</span>
                                                <span class="text-[9px] font-semibold px-2 py-0.5 rounded-md {{ $s->tipe === 'pilihan_ganda' ? 'bg-[#F3EDE2] text-[#6E4A2E]' : 'bg-blue-50 text-blue-700' }}">
                                                    {{ $s->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Esai' }}
                                                </span>
                                            </div>
                                            <p class="text-sm font-medium text-[#241508] mb-3">{{ $s->pertanyaan }}</p>

                                            @if($s->tipe === 'pilihan_ganda')
                                                <div class="space-y-2">
                                                    @foreach(['A' => $s->opsi_a, 'B' => $s->opsi_b, 'C' => $s->opsi_c, 'D' => $s->opsi_d] as $opsi => $teks)
                                                        @if($teks)
                                                            <label class="flex items-center gap-2.5 p-2.5 bg-white border border-[#E6D9C6] rounded-lg cursor-pointer hover:bg-[#F3EDE2] transition-colors">
                                                                <input type="radio" name="jawaban[{{ $s->id }}]" value="{{ $opsi }}" required class="text-[#4A2E1A] focus:ring-[#8B6340]" />
                                                                <span class="text-xs font-bold text-[#6E4A2E] shrink-0">{{ $opsi }}.</span>
                                                                <span class="text-sm text-[#241508]">{{ $teks }}</span>
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <textarea name="jawaban[{{ $s->id }}]" rows="3" placeholder="Ketikkan jawaban Anda..."
                                                    class="w-full bg-white border border-[#E6D9C6] rounded-lg p-3 text-sm text-[#241508] focus:outline-none focus:border-[#8B6340] resize-none"></textarea>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="flex items-center justify-end gap-3 pt-2">
                                        <button type="button" onclick="bukaUjian({{ $kuis->id }})" class="text-xs text-[#8B6340] hover:text-[#4A2E1A] px-4 py-2 transition-colors">Tutup</button>
                                        <button type="submit" class="flex items-center gap-2 text-xs font-semibold bg-[#4A2E1A] text-[#FAF8F4] px-6 py-2.5 rounded-lg hover:bg-[#241508] transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"/>
                                            </svg>
                                            Kirim & Selesaikan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="bg-white border border-[#E6D9C6] rounded-xl px-6 py-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#D4C0A0] mx-auto mb-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4"/>
                    </svg>
                    <p class="text-sm font-medium text-[#4A2E1A]">Belum ada kuis</p>
                    <p class="text-xs text-[#8B6340] mt-1">Guru belum membuat kuis untuk Anda.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function bukaUjian(kuisId) {
    const lembar = document.getElementById('lembar-ujian-' + kuisId);
    if (lembar) lembar.classList.toggle('hidden');
}
</script>
