@extends('layouts.app')

@section('title', 'SINAU — Siswa')

@section('content')
<div class="flex h-screen font-sans overflow-hidden">

    <!-- Partial Sidebar Siswa -->
    @include('partials.sidebar-siswa')

    <!-- Konten Utama Siswa -->
    <main class="flex-1 overflow-y-auto">

        <!-- 1. Modul Dashboard / Kursus Aktif -->
        @include('siswa.kelas.index')

        <!-- 2. Modul Pelajari Materi -->
        @include('siswa.materi.index')

        <!-- 3. Modul Kerjakan Kuis -->
        @include('siswa.kuis.index')

        <!-- 4. Modul Rekap Nilai -->
        @include('siswa.rekap.index')

    </main>
</div>

<!-- Tombol Ganti Akun -->
<a href="/" class="fixed bottom-5 right-5 text-xs text-[#C4A882] hover:text-[#A67C52] transition-colors">← Ganti Akun</a>
@endsection

@section('scripts')
<script>
    const snavIds = ['dashboard','materi','quiz','nilai'];

    function showTab(tab) {
        if (!snavIds.includes(tab)) return;

        localStorage.setItem('sinau_siswa_tab', tab);
        if (window.location.hash !== '#' + tab) {
            history.replaceState(null, null, '#' + tab);
        }

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        snavIds.forEach(id => {
            const btn = document.getElementById('nav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#5A3E28]');
            btn.classList.remove('text-[#FAF7F2]');
        });
        const target = document.getElementById('tab-' + tab);
        if (target) target.classList.add('active');
        const nav = document.getElementById('nav-' + tab);
        if (nav) { nav.classList.add('nav-active'); nav.classList.remove('text-[#5A3E28]'); }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = hash || urlParams.get('tab') || localStorage.getItem('sinau_siswa_tab') || 'dashboard';
        if (snavIds.includes(activeTab)) {
            showTab(activeTab);
        }
    });

    function toggleDone(btn) {
        const isDone = btn.dataset.done === '1';
        if (isDone) {
            btn.textContent = 'Tandai Selesai ✓';
            btn.classList.replace('bg-[#D4C5A9]','bg-[#7A5C3A]');
            btn.classList.replace('text-[#7A6050]','text-[#FAF7F2]');
            btn.dataset.done = '0';
        } else {
            btn.textContent = 'Batalkan';
            btn.classList.replace('bg-[#7A5C3A]','bg-[#D4C5A9]');
            btn.classList.replace('text-[#FAF7F2]','text-[#7A6050]');
            btn.dataset.done = '1';
        }
    }

    function submitComment(e) {
        e.preventDefault();
        const input = document.getElementById('comment-input');
        const text = input.value.trim();
        if (!text) return;
        const div = document.createElement('div');
        div.className = 'flex gap-3';
        div.innerHTML = `<div class="w-9 h-9 rounded-full bg-[#C4A882] flex items-center justify-center text-[#2C1A0E] font-semibold text-xs shrink-0 mt-0.5">K8</div>
            <div class="flex-1"><div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                <div class="flex items-center justify-between mb-1.5"><span class="text-sm font-semibold text-[#2C1A0E]">Kelompok 8</span><span class="text-xs text-[#7A6050]">Baru saja</span></div>
                <p class="text-sm text-[#3D2314]">${text}</p></div></div>`;
        document.getElementById('comment-list').prepend(div);
        input.value = '';
    }

    function downloadCert(title) {
        const blob = new Blob([`SERTIFIKAT PENYELESAIAN\n\nDiberikan kepada: Kelompok 8\nKursus: ${title}\n\nPlatform SINAU`], {type:'text/plain'});
        const a = document.createElement('a'); a.href = URL.createObjectURL(blob);
        a.download = 'Sertifikat-' + title.replace(/[^a-z0-9]/gi,'_') + '.txt'; a.click();
    }
</script>
@endsection
