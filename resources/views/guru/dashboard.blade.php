@extends('layouts.app')

@section('title', 'SINAU — Guru')

@section('content')
<div class="flex flex-col h-screen overflow-hidden">

    <!-- Partial Topbar Header -->
    @include('partials.topbar', ['roleTitle' => 'Mode Guru'])

    <div class="flex flex-1 overflow-hidden">

        <!-- Partial Sidebar Guru -->
        @include('partials.sidebar-guru')

        <!-- Konten Utama Guru -->
        <main class="flex-1 overflow-y-auto">
            <div class="max-w-3xl mx-auto px-7 py-7">

                <!-- Stats Global (selalu tampil) -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-7">
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Total Siswa</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">8</p>
                        <p class="text-[10px] text-[#A67C52]">terdaftar</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Rata-rata Kelas</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">79</p>
                        <p class="text-[10px] text-[#A67C52]">dari 100</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Siswa Lulus</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">6</p>
                        <p class="text-[10px] text-[#A67C52]">≥70 rata-rata</p>
                    </div>
                    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-xl px-4 py-3">
                        <p class="text-[10px] text-[#7A6050] mb-0.5">Kuis Aktif</p>
                        <p class="font-serif text-xl font-bold text-[#2C1A0E]">{{ isset($kuisList) ? $kuisList->count() : 3 }}</p>
                        <p class="text-[10px] text-[#A67C52]">topik</p>
                    </div>
                </div>

                <!-- 1. Modul Rekap Nilai -->
                @include('guru.rekap.index')

                <!-- 2. Modul Izin Pembahasan -->
                @include('guru.izin.index')

                <!-- 3. Modul Sertifikat -->
                @include('guru.sertifikat.index')

                <!-- 4. Modul Nilai Esai -->
                @include('guru.esai.index')

                <!-- 5. Modul Bank Soal & Kuis (Create & List) -->
                @include('guru.kuis.index')

                <!-- 6. Modul Unggah Materi (Create & List) -->
                @include('guru.materi.index')

                <!-- 7. Modul Kelola Kelas (Create & List) -->
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

        // Simpan ke URL hash dan localStorage
        localStorage.setItem('sinau_guru_tab', tab);
        if (window.location.hash !== '#' + tab) {
            history.replaceState(null, null, '#' + tab);
        }

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        gnavIds.forEach(id => {
            const btn = document.getElementById('gnav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#5A3E28]');
            btn.classList.remove('text-[#FAF7F2]');
        });

        const activeContent = document.getElementById('tab-' + tab);
        if (activeContent) activeContent.classList.add('active');

        const activeNav = document.getElementById('gnav-' + tab);
        if (activeNav) {
            activeNav.classList.add('nav-active');
            activeNav.classList.remove('text-[#5A3E28]');
        }
    }

    // Auto restore tab saat reload / redirect
    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = hash || urlParams.get('tab') || localStorage.getItem('sinau_guru_tab') || 'nilai';
        if (gnavIds.includes(activeTab)) {
            showTab(activeTab);
        }
    });

    function togglePermission(id, btn) {
        const isOn = btn.classList.contains('bg-[#7A5C3A]');
        const label = document.getElementById('label-' + id);
        if (isOn) {
            btn.classList.replace('bg-[#7A5C3A]', 'bg-[#D4C5A9]');
            btn.querySelector('span').classList.replace('left-5', 'left-0.5');
            label.textContent = '✗ Tutup'; label.className = 'text-xs font-medium text-[#A67C52]';
        } else {
            btn.classList.replace('bg-[#D4C5A9]', 'bg-[#7A5C3A]');
            btn.querySelector('span').classList.replace('left-0.5', 'left-5');
            label.textContent = '✓ Buka'; label.className = 'text-xs font-medium text-[#7A5C3A]';
        }
    }

    function simpanNilai(input) {
        const val = parseInt(input.value);
        if (isNaN(val) || val < 0 || val > 100) return;
        const wrapper = input.closest('.flex.items-center.gap-2');
        wrapper.innerHTML = `<span class="text-lg font-bold text-[#7A5C3A]">${val}</span>
            <span class="text-[11px] font-bold px-1.5 py-0.5 rounded bg-[#7A5C3A]/15 text-[#7A5C3A]">${val >= 85 ? 'A' : val >= 70 ? 'B' : val >= 55 ? 'C' : 'D'}</span>
            <button onclick="this.parentElement.innerHTML='<input type=number class=\\'w-20 bg-[#F7F3EC] border border-[#D4C5A9] rounded-lg px-3 py-1.5 text-sm text-center focus:outline-none\\' /><button onclick=\\'simpanNilai(this.previousElementSibling)\\' class=\\'text-xs font-semibold bg-[#7A5C3A] text-[#FAF7F2] px-3 py-1.5 rounded-lg\\'>Simpan</button>'" class="text-[10px] text-[#A67C52] hover:text-[#7A5C3A]">Ubah</button>`;
    }
</script>
@endsection
