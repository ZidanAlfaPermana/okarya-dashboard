@if(session()->has('success') || session()->has('error') || session()->has('warning'))
    <div x-data="{ show: false }"
         x-init="
            setTimeout(() => show = true, 50);
            setTimeout(() => show = false, 3050);
         "
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-10"
         class="fixed top-3 left-1/2 transform -translate-x-1/2 z-[100]"
         style="display: none;">
        <div @class([
            'flex items-center gap-3 px-5 py-2 rounded-full shadow-lg min-w-[280px]',
            'bg-[#07E200] text-white shadow-[#07E200]/30 border border-white/20' => session()->has('success'),
            'bg-red-500 text-white shadow-red-500/30 border border-white/20' => session()->has('error'),
            'bg-yellow-400 text-gray-900 shadow-yellow-400/30 border border-black/10' => session()->has('warning'),
        ])>
            <div class="flex-shrink-0">
                @if(session()->has('success'))
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                @elseif(session()->has('error'))
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif(session()->has('warning'))
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                @endif
            </div>
            <p class="text-xs font-bold tracking-wide">
                {{ session('success') ?? session('error') ?? session('warning') }}
            </p>
            <button @click="show = false" type="button" class="ml-auto p-1.5 rounded-full hover:bg-black/10 transition-colors focus:outline-none">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif
