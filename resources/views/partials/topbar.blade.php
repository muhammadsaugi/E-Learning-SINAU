<!-- Topbar Header -->
<header class="h-14 bg-[#241508] px-6 flex items-center justify-between shrink-0 border-b border-[#3D2211]">
    <div class="flex items-center gap-3">
        <!-- Logo Mark -->
        <div class="w-7 h-7 rounded-lg bg-[#8B6340] flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#FAF8F4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>
        <div>
            <p class="font-display text-[#FAF8F4] text-sm leading-none">{{ $roleTitle ?? (Auth::user() ? ucfirst(Auth::user()->role) : 'Guru') }} — SINAU</p>
            <p class="text-[#A87C52] text-[11px] leading-none mt-1">{{ Auth::user()->name ?? 'Pengguna' }}</p>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="flex items-center gap-2 text-[11px] font-medium text-[#A87C52] border border-[#A87C52]/30 px-3.5 py-1.5 rounded-lg hover:bg-[#A87C52]/10 transition-colors cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
        </button>
    </form>
</header>
