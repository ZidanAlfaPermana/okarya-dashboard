<div class="font-sans bg-gray-50 text-gray-800 h-screen overflow-hidden">
    <div id="overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden"></div>
    <div class="flex h-screen">
        <x-sidebar></x-sidebar>
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <header class="sticky top-0 z-10 bg-white border-b border-gray-100 px-4 sm:px-6 py-3.5 flex items-center gap-4">
                <button id="openSide" class="md:hidden p-1.5 rounded-lg text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex-1">
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard Produk</h1>
                </div>
            </header>
            <main class="flex-1 p-4 sm:p-6 space-y-6">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="flex items-center gap-3 bg-[#F0FDF0] border border-[#07E200]/30 text-green-700 text-sm font-medium px-4 py-3 rounded-xl">
                        <svg class="w-4 h-4 flex-shrink-0 text-[#07E200]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                <div>
                    <div class="flex items-center gap-2 text-xs text-gray-400 mb-1.5">
                        <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                        <span class="text-gray-600 font-medium">Pengaturan Profil</span>
                    </div>
                    <h1 class="text-xl font-extrabold text-gray-900">Profil Saya</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="space-y-6">
                        <div class="bg-white border border-gray-100 rounded-2xl p-8 flex flex-col items-center text-center">
                            <div class="px-6 py-3.5 rounded-full bg-[#07E200] flex items-center justify-center text-white text-3xl font-black shadow-lg shadow-[#07E200]/20">
                                {{ strtoupper(substr($name, 0, 1)) }}
                            </div>
                            <div class="mt-4">
                                <h2 class="text-lg font-bold text-gray-900">{{ $name }}</h2>
                                <p class="text-sm text-gray-400">{{ $email }}</p>
                            </div>
                            <div class="mt-6 w-full pt-6 border-t border-gray-50 flex items-center justify-between text-xs font-semibold uppercase tracking-wider">
                                <span class="text-gray-400">Status</span>
                                @if($email_verified_at)
                                    <span class="text-[#07E200] bg-[#F0FDF0] px-2 py-0.5 rounded-md">Terverifikasi</span>
                                @else
                                    <span class="text-orange-500 bg-orange-50 px-2 py-0.5 rounded-md">Pending</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-6">Informasi Personal</p>
                            <div class="space-y-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Nama Lengkap</label>
                                    <input type="text" wire:model="name" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#07E200]/20 focus:border-[#07E200] outline-none transition-all">
                                    @error('name') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Alamat Email</label>
                                    <input type="email" wire:model="email" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#07E200]/20 focus:border-[#07E200] outline-none transition-all">
                                    @error('email') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-6">Keamanan</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Password Baru</label>
                                    <input type="password" wire:model="password" placeholder="••••••••" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#07E200]/20 focus:border-[#07E200] outline-none transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Konfirmasi Password</label>
                                    <input type="password" wire:model="password_confirmation" placeholder="••••••••" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#07E200]/20 focus:border-[#07E200] outline-none transition-all">
                                </div>
                                <div class="md:col-span-2 pt-4">
                                    <button wire:click="updateProfile" wire:loading.attr="disabled" class="inline-flex items-center gap-2 bg-[#07E200] text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-[#07E200]/20 hover:opacity-90 transition-all disabled:opacity-50">
                                        <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                                        <span wire:loading wire:target="updateProfile" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
