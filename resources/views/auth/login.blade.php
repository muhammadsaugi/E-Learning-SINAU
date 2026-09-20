@extends('layouts.guest')

@section('title', 'SINAU — Login')

@section('content')
<div class="w-full max-w-2xl">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-[#7A5C3A] flex items-center justify-center">
                <span class="text-[#FAF7F2] font-serif font-bold">S</span>
            </div>
            <span class="font-serif text-2xl font-semibold text-[#2C1A0E] tracking-wide">SINAU</span>
        </div>
        <p class="text-sm text-[#7A6050]">Platform Pembelajaran Digital · Pilih peran Anda atau masuk dengan akun</p>
    </div>

    <!-- Quick Role Selection Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

        <!-- Siswa -->
        <a href="{{ route('login.as', 'siswa') }}" class="group bg-[#EDE5D8] border border-[#D4C5A9] rounded-2xl p-6 flex flex-col items-center gap-3 hover:border-[#7A5C3A] hover:shadow-md transition-all duration-200 cursor-pointer text-center">
            <div class="w-14 h-14 rounded-2xl bg-[#D4C5A9] group-hover:bg-[#7A5C3A] flex items-center justify-center text-2xl transition-colors duration-200">
                🎓
            </div>
            <div>
                <p class="font-serif text-base font-semibold text-[#2C1A0E]">Siswa</p>
                <p class="text-[11px] text-[#7A6050] mt-0.5">Akses materi & kuis</p>
            </div>
            <span class="text-xs font-semibold text-[#7A5C3A] group-hover:text-[#5A3E28] transition-colors">Masuk Siswa →</span>
        </a>

        <!-- Guru -->
        <a href="{{ route('login.as', 'guru') }}" class="group bg-[#EDE5D8] border border-[#D4C5A9] rounded-2xl p-6 flex flex-col items-center gap-3 hover:border-[#7A5C3A] hover:shadow-md transition-all duration-200 cursor-pointer text-center">
            <div class="w-14 h-14 rounded-2xl bg-[#D4C5A9] group-hover:bg-[#7A5C3A] flex items-center justify-center text-2xl transition-colors duration-200">
                👨‍🏫
            </div>
            <div>
                <p class="font-serif text-base font-semibold text-[#2C1A0E]">Guru</p>
                <p class="text-[11px] text-[#7A6050] mt-0.5">Kelola kelas & nilai</p>
            </div>
            <span class="text-xs font-semibold text-[#7A5C3A] group-hover:text-[#5A3E28] transition-colors">Masuk Guru →</span>
        </a>

        <!-- Admin -->
        <a href="{{ route('login.as', 'admin') }}" class="group bg-[#EDE5D8] border border-[#D4C5A9] rounded-2xl p-6 flex flex-col items-center gap-3 hover:border-[#7A5C3A] hover:shadow-md transition-all duration-200 cursor-pointer text-center">
            <div class="w-14 h-14 rounded-2xl bg-[#D4C5A9] group-hover:bg-[#7A5C3A] flex items-center justify-center text-2xl transition-colors duration-200">
                ⚙️
            </div>
            <div>
                <p class="font-serif text-base font-semibold text-[#2C1A0E]">Admin</p>
                <p class="text-[11px] text-[#7A6050] mt-0.5">Pantau seluruh sistem</p>
            </div>
            <span class="text-xs font-semibold text-[#7A5C3A] group-hover:text-[#5A3E28] transition-colors">Masuk Admin →</span>
        </a>

    </div>

    <!-- Manual Login Form (Email & Password) -->
    <div class="bg-[#EDE5D8] border border-[#D4C5A9] rounded-2xl p-6 max-w-md mx-auto shadow-sm">
        <p class="text-xs font-semibold text-[#A67C52] uppercase tracking-widest text-center mb-4">Atau Masuk dengan Email</p>
        
        <form action="{{ route('login.post') }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <label class="text-xs text-[#7A6050] font-medium mb-1 block">Email</label>
                <input type="email" name="email" required placeholder="guru@sinau.test" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            </div>

            <div>
                <label class="text-xs text-[#7A6050] font-medium mb-1 block">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full bg-[#F7F3EC] border border-[#D4C5A9] rounded-xl px-4 py-2.5 text-sm text-[#2C1A0E] focus:outline-none focus:border-[#7A5C3A]" />
            </div>

            <button type="submit" class="w-full text-sm font-semibold bg-[#7A5C3A] text-[#FAF7F2] py-2.5 rounded-xl hover:bg-[#5A3E28] transition-colors mt-2">
                Masuk ke Platform
            </button>
        </form>

        <div class="mt-4 pt-3 border-t border-[#D4C5A9] text-center">
            <p class="text-[11px] text-[#7A6050]">Akun demo: <span class="font-mono text-[#2C1A0E]">guru@sinau.test</span> / <span class="font-mono text-[#2C1A0E]">password123</span></p>
        </div>
    </div>

    <p class="text-center text-xs text-[#C4A882] mt-6">© 2024 SINAU · Platform Belajar Digital</p>
</div>
@endsection
