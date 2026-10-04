@extends('layouts.app')

@section('title', 'SINAU — Guru')

@section('content')
<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Guru -->
    @include('partials.sidebar-guru')

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto" style="background: #EDE5D8;">
        <div class="max-w-3xl mx-auto px-7 py-7">



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
            btn.classList.add('text-[#C4A882]');
        });

        const activeContent = document.getElementById('tab-' + tab);
        if (activeContent) activeContent.classList.add('active');

        const activeNav = document.getElementById('gnav-' + tab);
        if (activeNav) {
            activeNav.classList.add('nav-active');
            activeNav.classList.remove('text-[#C4A882]');
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
