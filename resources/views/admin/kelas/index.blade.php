<!-- ─── TAB MONITORING KELAS ADMIN ─── -->
<div id="tab-kelas" class="tab-content">
    <div class="mb-6">
        <h1 class="font-display text-2xl text-[#241508]">Monitoring Kelas</h1>
        <p class="text-sm text-[#8B6340] mt-0.5">Pantau status dan aktivitas seluruh kelas yang berjalan.</p>
    </div>

    <div class="bg-white border border-[#E6D9C6] rounded-xl overflow-hidden">
        <div class="grid grid-cols-12 px-5 py-3 bg-[#FAF8F4] border-b border-[#F3EDE2]">
            <span class="col-span-5 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Kelas</span>
            <span class="col-span-3 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340]">Mata Pelajaran</span>
            <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-center">Status</span>
            <span class="col-span-2 text-[10px] font-semibold uppercase tracking-wider text-[#8B6340] text-right">Aksi</span>
        </div>

        @php
        $kelasData = [
            ['nama' => 'Matematika 10A', 'kode' => 'MTH10A', 'mapel' => 'Matematika'],
            ['nama' => 'Kelas 11 IPA 2', 'kode' => 'BIO11B', 'mapel' => 'Biologi'],
            ['nama' => 'Kimia XII', 'kode' => 'KIM12A', 'mapel' => 'Kimia'],
        ];
        @endphp

        @foreach($kelasData as $i => $k)
            <div class="grid grid-cols-12 px-5 py-4 items-center border-b border-[#FAF8F4] last:border-0 hover:bg-[#FAF8F4] transition-colors">
                <div class="col-span-5">
                    <p class="text-sm font-semibold text-[#241508]">{{ $k['nama'] }}</p>
                    <span class="text-[10px] font-mono font-semibold px-2 py-0.5 rounded-md bg-[#F3EDE2] text-[#6E4A2E] border border-[#D4C0A0]">{{ $k['kode'] }}</span>
                </div>
                <span class="col-span-3 text-[11px] text-[#8B6340]">{{ $k['mapel'] }}</span>
                <div class="col-span-2 flex justify-center">
                    <span class="text-[9px] font-semibold px-2 py-0.5 rounded-full bg-[#e8f5e9] text-[#2e7d32] border border-[#a5d6a7]">Aktif</span>
                </div>
                <div class="col-span-2 flex justify-end">
                    <button class="text-xs font-medium text-[#4A2E1A] hover:text-[#241508] underline underline-offset-2 transition-colors">Detail</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
