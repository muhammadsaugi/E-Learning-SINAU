@extends('layouts.app')

@section('title', 'SINAU — Admin')

@section('content')
<!-- Partial Modal Tambah Pengguna Baru -->
@include('admin.users.create')

<div class="flex h-screen overflow-hidden">

    <!-- Partial Sidebar Admin -->
    @include('partials.sidebar-admin')

    <!-- Konten Utama Admin -->
    <main class="flex-1 overflow-y-auto" style="background:#EDE5D8;">
        <div class="max-w-4xl mx-auto px-8 py-8">

            <!-- 1. Modul Aktivitas & Stats -->
            @include('admin.aktivitas.index')

            <!-- 2. Modul Monitoring Kelas -->
            @include('admin.kelas.index')

            <!-- 3. Modul Kelola Akun Guru & Siswa -->
            @include('admin.users.index')

            <!-- 4. Modul Log Sertifikat -->
            @include('admin.sertifikat.index')

        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    const anavIds = ['aktivitas','kelas','akun','sertifikat'];

    function showTab(tab) {
        if (!anavIds.includes(tab)) return;

        localStorage.setItem('sinau_admin_tab', tab);
        if (window.location.hash !== '#' + tab) {
            history.replaceState(null, null, '#' + tab);
        }

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        anavIds.forEach(id => {
            const btn = document.getElementById('anav-' + id) || document.getElementById('nav-' + id);
            if (!btn) return;
            btn.classList.remove('nav-active');
            btn.classList.add('text-[#C4A882]');
            btn.classList.remove('text-[#FAF7F2]');
        });
        const target = document.getElementById('tab-' + tab);
        if (target) target.classList.add('active');
        const nav = document.getElementById('anav-' + tab) || document.getElementById('nav-' + tab);
        if (nav) { nav.classList.add('nav-active'); nav.classList.remove('text-[#C4A882]'); }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = hash || urlParams.get('tab') || localStorage.getItem('sinau_admin_tab') || 'aktivitas';
        if (anavIds.includes(activeTab)) {
            showTab(activeTab);
        }
    });

    function openModal(type) {
        const overlay = document.getElementById('modal-overlay');
        const title = document.getElementById('modal-title');
        const roleInput = document.getElementById('modal-input-role');
        if (type === 'guru') {
            title.textContent = 'Tambah Guru Baru';
            if (roleInput) roleInput.value = 'guru';
        } else if (type === 'siswa') {
            title.textContent = 'Tambah Siswa Baru';
            if (roleInput) roleInput.value = 'siswa';
        }
        overlay.classList.add('open');
    }

    function closeModal() {
        document.getElementById('modal-overlay').classList.remove('open');
    }

    function submitModal() {
        alert('Data berhasil disimpan secara lokal!');
        closeModal();
    }

    function hapusRow(btn) {
        if (confirm('Yakin ingin menghapus item ini?')) {
            btn.closest('.bg-\\[\\#EDE5D8\\]') ? btn.closest('.bg-\\[\\#EDE5D8\\]').remove() : btn.closest('.grid').remove();
        }
    }
</script>
@endsection
