<!-- Flash Messages & Validation Alert -->
@if(session('success'))
    <div id="flash-success" class="fixed top-5 right-5 z-50 flex items-start gap-3 bg-[#241508] text-[#FAF8F4] text-xs font-medium px-5 py-3.5 rounded-xl shadow-2xl border border-[#8B6340]/50 max-w-sm">
        <div class="w-5 h-5 rounded-full bg-[#8B6340] flex items-center justify-center shrink-0 mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-[#E6D9C6] text-[11px] uppercase tracking-wide mb-0.5">Berhasil</p>
            <p class="text-[#FAF8F4]">{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('flash-success').remove()" class="ml-2 text-[#A87C52] hover:text-[#FAF8F4] transition-colors mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
@if(session('error'))
    <div id="flash-danger" class="fixed top-5 right-5 z-50 flex items-start gap-3 bg-red-900 text-white text-xs font-medium px-5 py-3.5 rounded-xl shadow-2xl border border-red-700 max-w-sm">
        <div class="w-5 h-5 rounded-full bg-red-700 flex items-center justify-center shrink-0 mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-red-200 text-[11px] uppercase tracking-wide mb-0.5">Peringatan</p>
            <p class="text-white">{{ session('error') }}</p>
        </div>
        <button onclick="document.getElementById('flash-danger').remove()" class="ml-2 text-red-400 hover:text-white transition-colors mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
@endif

@if($errors->any())
    <div id="flash-error" class="fixed top-5 right-5 z-50 flex items-start gap-3 bg-red-900 text-white text-xs font-medium px-5 py-3.5 rounded-xl shadow-2xl border border-red-700 max-w-sm">
        <div class="w-5 h-5 rounded-full bg-red-700 flex items-center justify-center shrink-0 mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </div>
        <div>
            <p class="font-semibold text-red-200 text-[11px] uppercase tracking-wide mb-1">Validasi Gagal</p>
            <ul class="space-y-0.5 list-none">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="document.getElementById('flash-error').remove()" class="ml-2 text-red-400 hover:text-white transition-colors mt-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
@endif

<div id="toast" class="fixed top-5 right-5 z-50 bg-[#241508] text-[#FAF8F4] text-xs font-medium px-5 py-3 rounded-xl shadow-lg border border-[#8B6340]/30"></div>

<script>
// Auto-dismiss flash messages after 4 seconds
document.addEventListener('DOMContentLoaded', () => {
    ['flash-success', 'flash-error', 'flash-danger'].forEach(id => {
        const el = document.getElementById(id);
        if (el) setTimeout(() => el.style.opacity = '0', 4500);
        if (el) setTimeout(() => el.remove(), 5000);
    });
});
</script>
