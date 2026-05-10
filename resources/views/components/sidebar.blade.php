<div x-data="{ sidebarOpen: false }">
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 z-20 md:hidden">
    </div>

    <aside
        id="sidebar"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 h-full z-30 flex flex-col bg-white border-r border-gray-100 shadow-sm w-64 transition-transform duration-300 md:translate-x-0 md:static md:flex flex-shrink-0">

        <div class="flex items-center justify-between gap-3 px-5 py-5 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <img src="https://www.smkn5malang.sch.id/storage/img/logo.png" class="w-9 h-9 rounded-xl" alt="">
                <div>
                    <p class="text-base font-extrabold text-gray-900 leading-tight">Toko Vohisma</p>
                    <p class="text-[10px] text-gray-400 leading-tight">Toko karya siswa smkn 5 malang</p>
                </div>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden p-1 text-gray-400 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
            <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-400 px-3 mb-2">Menu Utama</p>
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('welcome') ? 'bg-[#07E200]/10 text-[#07E200]' : 'text-gray-600 hover:bg-gray-50' }}">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('welcome') ? 'bg-[#07E200] text-white' : 'bg-gray-100 text-gray-400' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 22V12h6v10" />
                    </svg>
                </span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>

            <a href="{{ route('produk') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('produk*') ? 'bg-[#07E200]/10 text-[#07E200]' : 'text-gray-600 hover:bg-gray-50' }}">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('produk*') ? 'bg-[#07E200] text-white' : 'bg-gray-100 text-gray-400' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                    </svg>
                </span>
                <span class="text-sm font-medium">Produk</span>
            </a>

            <a href="{{ route('kategori') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('kategori*') ? 'bg-[#07E200]/10 text-[#07E200]' : 'text-gray-600 hover:bg-gray-50' }}">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('kategori*') ? 'bg-[#07E200] text-white' : 'bg-gray-100 text-gray-400' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </span>
                <span class="text-sm font-medium">Kategori</span>
            </a>

            <a href="{{ route('pesanan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-gray-50 transition-colors">
                <span class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </span>
                <span class="text-sm font-medium">Pesanan</span>
                <span class="ml-auto text-[10px] font-bold text-white px-1.5 py-0.5 rounded-full bg-[#07E200]">8</span>
            </a>

            <div class="pt-4 pb-1">
                <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-400 px-3 mb-2">Account</p>
            </div>

            <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('user.profile') ? 'bg-[#07E200]/10 text-[#07E200]' : 'text-gray-600 hover:bg-gray-50' }}">
                <span class="w-8 h-8 rounded-lg flex items-center justify-center {{ request()->routeIs('user.profile') ? 'bg-[#07E200] text-white' : 'bg-gray-100 text-gray-400' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
                <span class="text-sm font-medium">Profile</span>
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold bg-[#07E200]"> {{ substr(auth()->user()->name, 0, 1) }} </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-gray-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                <livewire:auth.logout-button></livewire:auth.logout-button>
            </div>
        </div>
    </aside>

    <div class="md:hidden fixed top-4 left-4 z-20">
        <button @click="sidebarOpen = true" class="p-2 bg-white border border-gray-100 rounded-xl shadow-sm text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</div>
