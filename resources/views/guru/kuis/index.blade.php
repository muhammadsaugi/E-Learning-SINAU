<!-- ─── TAB BANK SOAL & KUIS ─── -->
<div id="tab-banksoal" class="tab-content">
    <h2 class="font-serif text-xl font-semibold text-[#2C1A0E] mb-2">Bank Soal & Kuis</h2>
    <p class="text-sm text-[#7A6050] mb-5">Buat kuis evaluasi dan tambahkan butir-butir pertanyaan pilihan ganda maupun esai.</p>
    
    <!-- Partial Form Buat Kuis & Tambah Butir Soal -->
    @include('guru.kuis.create')

    <!-- Daftar Kuis & Butir Soal Tersimpan -->
    <h3 class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest mb-3">Daftar Kuis & Butir Soal Tersimpan</h3>
    <div id="soal-list" class="space-y-4">
        @if(isset($kuisList) && $kuisList->count() > 0)
            @foreach($kuisList as $itemKuis)
                <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4 pb-3 border-b border-[#D4C5A9]">
                        <div class="flex items-start gap-3">
                            <span class="text-xl">📝</span>
                            <div>
                                <h4 class="text-base font-semibold text-[#2C1A0E]">{{ $itemKuis->judul }}</h4>
                                <p class="text-xs text-[#7A6050]">
                                    Kelas: <span class="font-medium text-[#2C1A0E]">{{ $itemKuis->kelas->nama_kelas ?? 'Umum' }}</span> · 
                                    Durasi: {{ $itemKuis->durasi_menit }} mnt · 
                                    KKM: {{ $itemKuis->passing_grade }} · 
                                    Total Soal: <span class="font-bold text-[#7A5C3A]">{{ $itemKuis->soal->count() }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <form action="{{ route('guru.kuis.destroy', $itemKuis->id) }}" method="POST" onsubmit="return confirm('Hapus seluruh kuis ini beserta soalnya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-700 hover:text-red-900 px-2.5 py-1 border border-red-300 rounded hover:bg-red-50">✕ Hapus Kuis</button>
                            </form>
                        </div>
                    </div>

                    <!-- Daftar Butir Soal di dalam Kuis Ini -->
                    <div class="mt-3 space-y-2">
                        @if($itemKuis->soal->count() > 0)
                            @foreach($itemKuis->soal as $index => $soal)
                                <div class="bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg p-3 text-xs">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="font-bold text-[#7A5C3A]">#{{ $index + 1 }}</span>
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold {{ $soal->tipe === 'pilihan_ganda' ? 'bg-[#7A5C3A] text-white' : 'bg-[#C4A882] text-[#2C1A0E]' }}">
                                                    {{ $soal->tipe === 'pilihan_ganda' ? 'Pilihan Ganda' : 'Teks / Esai' }}
                                                </span>
                                            </div>
                                            <p class="text-[#2C1A0E] font-medium text-sm">{{ $soal->pertanyaan }}</p>
                                            
                                            @if($soal->tipe === 'pilihan_ganda')
                                                <div class="grid grid-cols-2 gap-1 mt-2 text-[11px] text-[#5A3E28]">
                                                    <p><span class="font-bold">A:</span> {{ $soal->opsi_a }}</p>
                                                    <p><span class="font-bold">B:</span> {{ $soal->opsi_b }}</p>
                                                    @if($soal->opsi_c)<p><span class="font-bold">C:</span> {{ $soal->opsi_c }}</p>@endif
                                                    @if($soal->opsi_d)<p><span class="font-bold">D:</span> {{ $soal->opsi_d }}</p>@endif
                                                </div>
                                                <p class="mt-1.5 text-[10px] text-green-800 font-bold">✓ Kunci Jawaban: Opsi {{ $soal->kunci_jawaban }}</p>
                                            @else
                                                <p class="mt-1 text-[10px] text-[#7A6050] italic">Pedoman Jawaban: {{ $soal->kunci_jawaban }}</p>
                                            @endif
                                        </div>

                                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Hapus butir soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[10px] text-red-600 hover:text-red-800 p-1">✕</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-[11px] text-[#7A6050] italic py-1">Belum ada butir pertanyaan pada kuis ini. Tambahkan melalui form 2 di atas.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-5 py-5 text-center text-xs text-[#7A6050] italic">
                Belum ada kuis yang dibuat. Gunakan form di atas untuk membuat kuis baru.
            </div>
        @endif
    </div>
</div>
