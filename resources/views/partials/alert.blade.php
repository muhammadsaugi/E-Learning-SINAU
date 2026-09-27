<!-- Flash Messages & Validation Alert (Partial) -->
@if(session('success'))
    <div class="fixed top-5 right-5 z-50 bg-[#2C1A0E] text-[#FAF7F2] border border-[#A67C52] text-xs font-semibold px-5 py-3 rounded-xl shadow-xl flex items-center gap-2 animate-bounce">
        <span>✓</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="fixed top-5 right-5 z-50 bg-red-800 text-white border border-red-500 text-xs font-semibold px-5 py-3.5 rounded-xl shadow-xl space-y-1">
        <div class="flex items-center gap-2 mb-1">
            <span>⚠️</span>
            <span class="font-bold">Terjadi Kesalahan Validasi:</span>
        </div>
        <ul class="list-disc pl-5 font-normal text-[11px] space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div id="toast" class="fixed top-5 right-5 z-50 bg-[#2C1A0E] text-[#FAF7F2] text-xs font-medium px-5 py-3 rounded-xl shadow-lg"></div>
