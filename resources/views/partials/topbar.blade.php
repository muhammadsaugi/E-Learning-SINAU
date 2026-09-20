<!-- Topbar Header -->
<header class="bg-[#2C1A0E] px-8 py-4 flex items-center justify-between shrink-0">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#7A5C3A] flex items-center justify-center text-[#FAF7F2] text-xs font-bold">
            {{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 1)) }}
        </div>
        <div>
            <p class="text-[#FAF7F2] font-serif font-semibold text-base">{{ $roleTitle ?? (Auth::user() ? 'Mode ' . ucfirst(Auth::user()->role) : 'Mode Guru') }}</p>
            <p class="text-[#C4A882] text-xs">{{ Auth::user()->name ?? 'Bapak Hendra Kurnia · Matematika XII IPA 2' }}</p>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-xs font-medium text-[#C4A882] border border-[#C4A882]/40 px-4 py-2 rounded-lg hover:bg-[#C4A882]/10 transition-colors cursor-pointer">
            🔒 Keluar
        </button>
    </form>
</header>
