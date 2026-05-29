<x-layouts.app>
    <div class="bg-gray-50 text-gray-800 antialiased">
        <div class="min-h-screen flex items-center justify-center p-6">
            <div class="max-w-xl w-full text-center">

                <div class="relative mb-10 justify-center flex">
                    <svg class="w-64 h-64 text-gray-200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <rect x="60" y="100" width="80" height="60" rx="4" fill="currentColor" />
                        <rect x="40" y="130" width="70" height="50" rx="4" fill="#E5E7EB" />
                        <rect x="90" y="120" width="70" height="50" rx="4" fill="#D1D5DB" />
                        <path d="M60 100L100 80L140 100" stroke="#9CA3AF" stroke-width="2" fill="none"/>
                        <rect x="75" y="110" width="50" height="10" rx="2" fill="#9CA3AF" opacity="0.3" />
                    </svg>

                    <div class="absolute inset-0 flex items-center justify-center">
                        <h1 class="text-[100px] font-black text-gray-900/10 select-none">@yield('code')</h1>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">@yield('status_title')</h2>
                    <p class="text-gray-500 text-base max-w-md mx-auto leading-relaxed">
                        @yield('message')
                    </p>
                </div>

                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a onclick="history.back()" class="select-none cursor-pointer w-full sm:w-auto px-8 py-3 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-2xl hover:bg-gray-50 transition-all">
                        Kembali
                    </a>
                    <a href="/" class="w-full sm:w-auto px-8 py-3 text-sm font-bold text-white bg-[#07E200] rounded-2xl shadow-lg shadow-[#07E200]/20 hover:opacity-90 transition-all">
                        Ke Dashboard
                    </a>
                </div>

                <div class="mt-16 pt-8 border-t border-gray-100">
                    <div class="flex items-center justify-center gap-2">
                        <img src="https://www.smkn5malang.sch.id/storage/img/logo.png" class="w-6 h-6 grayscale opacity-50" alt="">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Okarya System</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
