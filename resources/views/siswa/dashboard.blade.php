@extends('layouts.app')

@section('title', 'SINAU — Siswa')

@section('content')
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Siswa -->
    @include('partials.sidebar-siswa')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto bg-[#FAF8F4]">

        <!-- Tab: Kelas Aktif -->
        @include('siswa.kelas.index')

        <!-- Tab: Materi -->
        @include('siswa.materi.index')

        <!-- Tab: Kuis -->
        @include('siswa.kuis.index')

        <!-- Tab: Nilai -->
        @include('siswa.rekap.index')

    </main>
</div>
@endsection

@section('scripts')
<script>
    const snavIds = ['dashboard','materi','quiz','nilai'];

    function showTab(tab) {
        if (!snavIds.includes(tab)) return;
        localStorage.setItem('sinau_siswa_tab', tab);
        if (window.location.hash !== '#' + tab) history.replaceState(null, null, '#' + tab);

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

        snavIds.forEach(id => {
            const btn = document.getElementById('nav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#6E4A2E]');
        });

        const target = document.getElementById('tab-' + tab);
        if (target) target.classList.add('active');

        const nav = document.getElementById('nav-' + tab);
        if (nav) { nav.classList.add('nav-active'); nav.classList.remove('text-[#6E4A2E]'); }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = hash || urlParams.get('tab') || localStorage.getItem('sinau_siswa_tab') || 'dashboard';
        if (snavIds.includes(activeTab)) showTab(activeTab);
    });

    function toggleDone(btn) {
        const isDone = btn.dataset.done === '1';
        if (isDone) {
            btn.textContent = 'Tandai Selesai';
            btn.classList.replace('bg-[#E6D9C6]', 'bg-[#4A2E1A]');
            btn.classList.replace('text-[#6E4A2E]', 'text-[#FAF8F4]');
            btn.dataset.done = '0';
        } else {
            btn.textContent = 'Selesai';
            btn.classList.replace('bg-[#4A2E1A]', 'bg-[#E6D9C6]');
            btn.classList.replace('text-[#FAF8F4]', 'text-[#6E4A2E]');
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
        const initials = '{{ strtoupper(substr(Auth::user()->name ?? "S", 0, 2)) }}';
        div.innerHTML = `<div class="w-8 h-8 rounded-full bg-[#D4C0A0] flex items-center justify-center text-[#4A2E1A] font-semibold text-xs shrink-0 mt-0.5">${initials}</div>
            <div class="flex-1"><div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-3">
                <div class="flex items-center justify-between mb-1"><span class="text-sm font-semibold text-[#241508]">{{ Auth::user()->name ?? 'Siswa' }}</span><span class="text-xs text-[#A87C52]">Baru saja</span></div>
                <p class="text-sm text-[#4A2E1A]">${text}</p></div></div>`;
        document.getElementById('comment-list')?.prepend(div);
        input.value = '';
    }

    function downloadCert(title) {
        const blob = new Blob([`SERTIFIKAT PENYELESAIAN\n\nDiberikan kepada: {{ Auth::user()->name ?? 'Siswa' }}\nKursus: ${title}\n\nPlatform SINAU`], {type:'text/plain'});
        const a = document.createElement('a'); a.href = URL.createObjectURL(blob);
        a.download = 'Sertifikat-' + title.replace(/[^a-z0-9]/gi,'_') + '.txt'; a.click();
    }
</script>
@endsection
