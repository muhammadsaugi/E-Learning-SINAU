<!-- ─── TAB EVALUASI KUIS SISWA (Dinamis & Terhubung ke Nilai) ─── -->
<div id="tab-quiz" class="tab-content">
    <div class="max-w-3xl mx-auto px-8 py-8">
        <div class="mb-6">
            <h1 class="font-serif text-2xl font-semibold text-[#2C1A0E]">Evaluasi & Kuis Online</h1>
            <p class="text-sm text-[#7A6050] mt-1">Uji pemahaman Anda dengan mengerjakan soal pilihan ganda maupun esai yang diberikan oleh guru.</p>
        </div>

        <div class="space-y-4">
            @if(isset($kuisList) && $kuisList->count() > 0)
                @foreach($kuisList as $kuis)
                    @php
                        $hasilNilai = isset($nilaiList) ? $nilaiList->where('kuis_id', $kuis->id)->first() : null;
                    @endphp

                    <div class="bg-[#EDE5D8] border @if($hasilNilai) border-[#7A5C3A] @else border-[#D4C5A9] @endif rounded-xl p-5 hover:shadow-sm transition-all">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3.5">
                                <div class="w-12 h-12 @if($hasilNilai) bg-[#7A5C3A] text-white @else bg-[#D4C5A9] text-[#2C1A0E] @endif rounded-xl flex items-center justify-center text-xl shrink-0 mt-0.5">
                                    @if($hasilNilai) ✓ @else ✎ @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[10px] font-semibold bg-[#C4A882] text-[#2C1A0E] px-2 py-0.5 rounded-full">
                                            {{ $kuis->kelas->nama_kelas ?? 'Umum' }}
                                        </span>
                                        <span class="text-xs text-[#7A6050]">
                                            {{ $kuis->kelas->mata_pelajaran ?? 'Pelajaran' }}
                                        </span>
                                        @if($hasilNilai)
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $hasilNilai->status === 'lulus' ? 'bg-green-800 text-white' : 'bg-red-700 text-white' }}">
                                                {{ $hasilNilai->status === 'lulus' ? '✓ Lulus' : '✗ Di Bawah KKM' }} (Skor: {{ $hasilNilai->nilai }})
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-serif text-lg font-semibold text-[#2C1A0E]">{{ $kuis->judul }}</h3>
                                    <p class="text-xs text-[#7A6050] mt-1">
                                        ⏱ Durasi: <span class="font-semibold text-[#2C1A0E]">{{ $kuis->durasi_menit }} Menit</span> · 
                                        🎯 KKM: <span class="font-semibold text-[#7A5C3A]">{{ $kuis->passing_grade }}</span> · 
                                        📝 Jumlah Soal: <span class="font-bold text-[#2C1A0E]">{{ $kuis->soal->count() }} butir</span>
                                    </p>
                                </div>
                            </div>

                            <div class="shrink-0 flex items-center">
                                @if($kuis->soal->count() > 0)
                                    @if($hasilNilai)
                                        <button onclick="bukaUjian({{ $kuis->id }})" 
                                            class="text-xs font-semibold bg-[#EDE5D8] border border-[#7A5C3A] text-[#7A5C3A] hover:bg-[#D4C5A9] px-3.5 py-2 rounded-xl transition-colors shadow-sm">
                                            Kerjakan Ulang
                                        </button>
                                    @else
                                        <button onclick="bukaUjian({{ $kuis->id }})" 
                                            class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-4 py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors shadow-sm">
                                            Mulai Mengerjakan →
                                        </button>
                                    @endif
                                @else
                                    <span class="text-xs text-[#7A6050] bg-[#D4C5A9]/50 px-3 py-1.5 rounded-lg">Soal Belum Ada</span>
                                @endif
                            </div>
                        </div>

                        <!-- Area Lembar Pengerjaan Soal (Modal / Collapsible Test Sheet) -->
                        @if($kuis->soal->count() > 0)
                            <div id="lembar-ujian-{{ $kuis->id }}" class="hidden mt-5 pt-4 border-t border-[#D4C5A9]">
                                <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-xl p-4 mb-3">
                                        <p class="text-xs font-bold text-[#7A5C3A] uppercase tracking-wider mb-1">Lembar Pengerjaan Ujian</p>
                                        <p class="text-xs text-[#7A6050]">Pilih jawaban yang paling tepat atau ketikkan jawaban Anda pada kolom yang disediakan.</p>
                                    </div>

                                    @foreach($kuis->soal as $idx => $s)
                                        <div class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-xl p-4">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-xs font-bold text-[#7A5C3A]">Soal #{{ $idx + 1 }}</span>
                                                <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full {{ $s->tipe === 'pilihan_ganda' ? 'bg-[#7A5C3A] text-white' : 'bg-[#C4A882] text-[#2C1A0E]' }}">
                                                    {{ $s->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Esai / Teks' }}
                                                </span>
                                            </div>
                                            <p class="text-sm font-medium text-[#2C1A0E] mb-3">{{ $s->pertanyaan }}</p>

                                            @if($s->tipe === 'pilihan_ganda')
                                                <!-- Opsi Radio Pilihan Ganda -->
                                                <div class="space-y-2 text-xs">
                                                    @if($s->opsi_a)
                                                        <label class="flex items-center gap-2.5 p-2 bg-white border border-[#D4C5A9] rounded-lg cursor-pointer hover:bg-[#EDE5D8]/50">
                                                            <input type="radio" name="jawaban[{{ $s->id }}]" value="A" required class="text-[#7A5C3A] focus:ring-[#7A5C3A]" />
                                                            <span class="font-bold text-[#7A5C3A]">A.</span>
                                                            <span class="text-[#2C1A0E]">{{ $s->opsi_a }}</span>
                                                        </label>
                                                    @endif
                                                    @if($s->opsi_b)
                                                        <label class="flex items-center gap-2.5 p-2 bg-white border border-[#D4C5A9] rounded-lg cursor-pointer hover:bg-[#EDE5D8]/50">
                                                            <input type="radio" name="jawaban[{{ $s->id }}]" value="B" required class="text-[#7A5C3A] focus:ring-[#7A5C3A]" />
                                                            <span class="font-bold text-[#7A5C3A]">B.</span>
                                                            <span class="text-[#2C1A0E]">{{ $s->opsi_b }}</span>
                                                        </label>
                                                    @endif
                                                    @if($s->opsi_c)
                                                        <label class="flex items-center gap-2.5 p-2 bg-white border border-[#D4C5A9] rounded-lg cursor-pointer hover:bg-[#EDE5D8]/50">
                                                            <input type="radio" name="jawaban[{{ $s->id }}]" value="C" class="text-[#7A5C3A] focus:ring-[#7A5C3A]" />
                                                            <span class="font-bold text-[#7A5C3A]">C.</span>
                                                            <span class="text-[#2C1A0E]">{{ $s->opsi_c }}</span>
                                                        </label>
                                                    @endif
                                                    @if($s->opsi_d)
                                                        <label class="flex items-center gap-2.5 p-2 bg-white border border-[#D4C5A9] rounded-lg cursor-pointer hover:bg-[#EDE5D8]/50">
                                                            <input type="radio" name="jawaban[{{ $s->id }}]" value="D" class="text-[#7A5C3A] focus:ring-[#7A5C3A]" />
                                                            <span class="font-bold text-[#7A5C3A]">D.</span>
                                                            <span class="text-[#2C1A0E]">{{ $s->opsi_d }}</span>
                                                        </label>
                                                    @endif
                                                </div>
                                            @else
                                                <!-- Input Textarea Esai -->
                                                <textarea name="jawaban[{{ $s->id }}]" rows="3" placeholder="Ketikkan jawaban Anda di sini..."
                                                    class="w-full bg-white border border-[#D4C5A9] rounded-lg p-3 text-xs text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]"></textarea>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="flex items-center justify-end gap-3 pt-2">
                                        <button type="button" onclick="bukaUjian({{ $kuis->id }})" class="text-xs text-[#7A6050] hover:underline px-4 py-2">Tutup</button>
                                        <button type="submit" class="text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-6 py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors shadow-sm">
                                            ✓ Kirim & Selesaikan Ujian
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-8 text-center text-xs text-[#7A6050] italic">
                    Belum ada kuis yang dibuat oleh guru saat ini.
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function bukaUjian(kuisId) {
    const lembar = document.getElementById('lembar-ujian-' + kuisId);
    if (lembar) {
        lembar.classList.toggle('hidden');
    }
}
</script>
