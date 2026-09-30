@extends('layouts.app')

@section('title', 'SINAU — Guru')

@section('content')
<div class="flex flex-col h-screen overflow-hidden">

    <!-- Topbar -->
    @include('partials.topbar', ['roleTitle' => 'Guru'])

    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar Guru -->
        @include('partials.sidebar-guru')

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto" style="background: #EDE5D8;">
            <div class="max-w-3xl mx-auto px-7 py-7">

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-7">
                    <!-- Card 1: Aksen Coklat Gelap -->
                    <div class="rounded-xl px-4 py-4" style="background:#4A2E1A; color:#FAF8F4;">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] font-medium opacity-70">Total Siswa</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 opacity-50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                            </svg>
                        </div>
                        <p class="font-display text-2xl">8</p>
                        <p class="text-[10px] opacity-60 mt-0.5">terdaftar</p>
                    </div>
                    <!-- Card 2: Cream sedang -->
                    <div class="rounded-xl px-4 py-4" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] font-medium text-[#8B6340]">Rata-rata</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                            </svg>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">79</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">dari 100</p>
                    </div>
                    <!-- Card 3: Cream sedang -->
                    <div class="rounded-xl px-4 py-4" style="background:#F3EDE2; border:1px solid #D4C0A0;">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] font-medium text-[#8B6340]">Lulus</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#A87C52]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">6</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">≥ KKM 70</p>
                    </div>
                    <!-- Card 4: Aksen medium -->
                    <div class="rounded-xl px-4 py-4" style="background:#6E4A2E; color:#FAF8F4;">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] font-medium opacity-70">Kuis Aktif</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 opacity-50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3L22 4"/>
                            </svg>
                        </div>
                        <p class="font-display text-2xl">{{ isset($kuisList) ? $kuisList->count() : 3 }}</p>
                        <p class="text-[10px] opacity-60 mt-0.5">topik</p>
                    </div>
                </div>

                <!-- Modules (each wrapped in cream card) -->
                <div style="background:#FAF8F4; border-radius:16px; border:1px solid #D4C0A0; padding:24px; margin-bottom:16px;">
                    @include('guru.rekap.index')
                    @include('guru.izin.index')
                    @include('guru.sertifikat.index')
                    @include('guru.esai.index')
                    @include('guru.kuis.index')
                    @include('guru.materi.index')
                    @include('guru.kelas.index')
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
        if (!gnavIds.includes(tab)) return;
        localStorage.setItem('sinau_guru_tab', tab);
        if (window.location.hash !== '#' + tab) history.replaceState(null, null, '#' + tab);

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

        gnavIds.forEach(id => {
            const btn = document.getElementById('gnav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#5A3E28]');
        });

        const activeContent = document.getElementById('tab-' + tab);
        if (activeContent) activeContent.classList.add('active');

        const activeNav = document.getElementById('gnav-' + tab);
        if (activeNav) {
            activeNav.classList.add('nav-active');
            activeNav.classList.remove('text-[#5A3E28]');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = hash || urlParams.get('tab') || localStorage.getItem('sinau_guru_tab') || 'nilai';
        if (gnavIds.includes(activeTab)) showTab(activeTab);
    });

    function togglePermission(id, btn) {
        const isOn = btn.classList.contains('bg-[#4A2E1A]');
        const label = document.getElementById('label-' + id);
        if (isOn) {
            btn.classList.replace('bg-[#4A2E1A]', 'bg-[#D4C0A0]');
            btn.querySelector('span').style.transform = 'translateX(2px)';
            label.textContent = 'Tutup';
            label.className = 'text-xs font-medium text-[#A87C52]';
        } else {
            btn.classList.replace('bg-[#D4C0A0]', 'bg-[#4A2E1A]');
            btn.querySelector('span').style.transform = 'translateX(20px)';
            label.textContent = 'Buka';
            label.className = 'text-xs font-medium text-green-700';
        }
    }

    function simpanNilai(input) {
        const val = parseInt(input.value);
        if (isNaN(val) || val < 0 || val > 100) return;
        const grade = val >= 85 ? 'A' : val >= 70 ? 'B' : val >= 55 ? 'C' : 'D';
        const cls = grade === 'A' ? 'badge-a' : grade === 'B' ? 'badge-b' : grade === 'C' ? 'badge-c' : 'badge-d';
        const wrapper = input.closest('.flex.items-center.gap-2');
        wrapper.innerHTML = `<span class="text-lg font-bold text-[#4A2E1A]">${val}</span>
            <span class="badge-grade ${cls}">${grade}</span>
            <button onclick="this.parentElement.innerHTML='<input type=\\'number\\' class=\\'w-16 form-input text-center\\' /><button onclick=\\'simpanNilai(this.previousElementSibling)\\' class=\\'text-xs font-semibold bg-[#4A2E1A] text-white px-2 py-1 rounded-lg\\'>OK</button>'" class="text-[11px] text-[#8B6340] hover:text-[#4A2E1A] font-medium">Ubah</button>`;
    }
</script>
@endsection
