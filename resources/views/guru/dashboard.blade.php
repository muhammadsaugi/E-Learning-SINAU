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
        <main class="flex-1 overflow-y-auto bg-[#FAF8F4]">
            <div class="max-w-3xl mx-auto px-7 py-7">

                <!-- Stats Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
                    <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] text-[#8B6340] font-medium">Total Siswa</p>
                            <div class="w-7 h-7 rounded-lg bg-[#F3EDE2] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#6E4A2E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                                </svg>
                            </div>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">8</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">terdaftar</p>
                    </div>
                    <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] text-[#8B6340] font-medium">Rata-rata</p>
                            <div class="w-7 h-7 rounded-lg bg-[#F3EDE2] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#6E4A2E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                                </svg>
                            </div>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">79</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">dari 100</p>
                    </div>
                    <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] text-[#8B6340] font-medium">Lulus</p>
                            <div class="w-7 h-7 rounded-lg bg-[#F3EDE2] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#6E4A2E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                            </div>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">6</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">≥ KKM 70</p>
                    </div>
                    <div class="bg-white border border-[#E6D9C6] rounded-xl px-4 py-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-[11px] text-[#8B6340] font-medium">Kuis Aktif</p>
                            <div class="w-7 h-7 rounded-lg bg-[#F3EDE2] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-[#6E4A2E]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 11l3 3L22 4"/>
                                </svg>
                            </div>
                        </div>
                        <p class="font-display text-2xl text-[#241508]">{{ isset($kuisList) ? $kuisList->count() : 3 }}</p>
                        <p class="text-[10px] text-[#A87C52] mt-0.5">topik</p>
                    </div>
                </div>

                <!-- Modules -->
                @include('guru.rekap.index')
                @include('guru.izin.index')
                @include('guru.sertifikat.index')
                @include('guru.esai.index')
                @include('guru.kuis.index')
                @include('guru.materi.index')
                @include('guru.kelas.index')

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
            btn.classList.add('text-[#6E4A2E]');
        });

        const activeContent = document.getElementById('tab-' + tab);
        if (activeContent) activeContent.classList.add('active');

        const activeNav = document.getElementById('gnav-' + tab);
        if (activeNav) {
            activeNav.classList.add('nav-active');
            activeNav.classList.remove('text-[#6E4A2E]');
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
            btn.classList.replace('bg-[#4A2E1A]', 'bg-[#E6D9C6]');
            btn.querySelector('span').classList.replace('translate-x-5', 'translate-x-0.5');
            label.textContent = 'Tutup';
            label.className = 'text-xs font-medium text-[#A87C52]';
        } else {
            btn.classList.replace('bg-[#E6D9C6]', 'bg-[#4A2E1A]');
            btn.querySelector('span').classList.replace('translate-x-0.5', 'translate-x-5');
            label.textContent = 'Buka';
            label.className = 'text-xs font-medium text-[#6E4A2E]';
        }
    }

    function simpanNilai(input) {
        const val = parseInt(input.value);
        if (isNaN(val) || val < 0 || val > 100) return;
        const grade = val >= 85 ? 'A' : val >= 70 ? 'B' : val >= 55 ? 'C' : 'D';
        const wrapper = input.closest('.flex.items-center.gap-2');
        wrapper.innerHTML = `<span class="text-lg font-bold text-[#4A2E1A]">${val}</span>
            <span class="badge-grade badge-${grade.toLowerCase()}">${grade}</span>
            <button onclick="this.parentElement.innerHTML='<input type=\\'number\\' class=\\'w-20 form-input text-center\\' /><button onclick=\\'simpanNilai(this.previousElementSibling)\\' class=\\'flex items-center gap-1.5 bg-[#4A2E1A] text-white text-xs font-semibold px-3 py-1.5 rounded-lg\\'>Simpan</button>'" class="text-[11px] text-[#A87C52] hover:text-[#4A2E1A] font-medium">Ubah</button>`;
    }
</script>
@endsection
