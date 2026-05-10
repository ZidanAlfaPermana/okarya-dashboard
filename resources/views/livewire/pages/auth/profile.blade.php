<div class="font-sans bg-gray-50/50 text-gray-800 h-screen overflow-hidden">
    <div id="overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden backdrop-blur-sm"></div>
    <div class="flex h-screen">
        <x-sidebar></x-sidebar>

        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-4 sm:px-6 py-3.5 flex items-center gap-4">
                <button id="openSide" class="md:hidden p-1.5 rounded-xl text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex-1">
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Pengaturan Akun</h1>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6 max-w-7xl mx-auto w-full">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 3000)" class="flex items-center gap-3 bg-[#F0FDF0] border border-[#07E200]/30 text-green-700 text-sm font-medium px-4 py-3 rounded-2xl shadow-sm shadow-[#07E200]/5">
                        <div class="bg-[#07E200] p-1 rounded-full text-white">
                            <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                        {{ session('success') }}
                    </div>
                @endif

                <div>
                    <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                        <a href="{{ route('welcome') }}" class="hover:text-[#07E200] transition-colors">Dashboard</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                        <span class="text-gray-600 font-semibold">Profil Saya</span>
                    </div>
                    <h1 class="text-2xl font-extrabold text-gray-900">Profil Saya</h1>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">
                            <div class="h-24 bg-gradient-to-r from-[#07E200]/20 to-[#07E200]/5 relative"></div>

                            <div class="px-6 pb-6 flex flex-col items-center text-center relative">
                                <div class="relative -mt-12 mb-4 group">
                                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-md flex items-center justify-center text-white text-3xl font-bold bg-[#07E200] transition-transform group-hover:scale-105">
                                        {{ substr(strtoupper(auth()->user()->name ?? 'U'), 0, 1) }}
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">{{ $name ?: 'Nama Pengguna' }}</h2>
                                    <p class="text-sm text-gray-500 font-medium">{{ $email ?: 'email@domain.com' }}</p>
                                </div>

                                <div class="mt-6 w-full pt-5 border-t border-gray-50 flex items-center justify-between text-xs font-bold uppercase tracking-wider">
                                    <span class="text-gray-400">Status Akun</span>
                                    @if($email_verified_at)
                                        <span class="text-[#07E200] bg-[#F0FDF0] px-3 py-1 rounded-lg border border-[#07E200]/20 flex items-center gap-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full bg-[#07E200]"></div> Terverifikasi
                                        </span>
                                    @else
                                        <span class="text-orange-500 bg-orange-50 px-3 py-1 rounded-lg border border-orange-200 flex items-center gap-1.5">
                                            <div class="w-1.5 h-1.5 rounded-full bg-orange-500"></div> Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-8 space-y-6">
                        <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                            <div class="mb-6">
                                <h3 class="text-base font-bold text-gray-900">Informasi Personal</h3>
                                <p class="text-sm text-gray-500 mt-1">Perbarui foto dan detail informasi akun Anda di sini.</p>
                            </div>

                            <div class="space-y-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text" wire:model="name" class="w-full pl-11 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-[#07E200]/10 focus:border-[#07E200] outline-none transition-all placeholder:text-gray-400" placeholder="Masukkan nama lengkap">
                                    </div>
                                    @error('name') <p class="text-[11px] font-medium text-red-500 mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Alamat Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="email" wire:model="email" class="w-full pl-11 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-[#07E200]/10 focus:border-[#07E200] outline-none transition-all placeholder:text-gray-400" placeholder="contoh@email.com">
                                    </div>
                                    @error('email') <p class="text-[11px] font-medium text-red-500 mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-3xl p-6 sm:p-8 shadow-sm">
                            <div class="mb-6">
                                <h3 class="text-base font-bold text-gray-900">Keamanan</h3>
                                <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Password Baru</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <input type="password" wire:model="password" placeholder="Biarkan kosong jika tidak diubah" class="w-full pl-11 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-[#07E200]/10 focus:border-[#07E200] outline-none transition-all placeholder:text-gray-400">
                                    </div>
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-600 uppercase tracking-wide">Konfirmasi Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <input type="password" wire:model="password_confirmation" placeholder="Ulangi password baru" class="w-full pl-11 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-[#07E200]/10 focus:border-[#07E200] outline-none transition-all placeholder:text-gray-400">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <button type="button" class="px-5 py-2.5 text-sm font-bold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all">
                                Batal
                            </button>
                            <button wire:click="updateProfile" wire:loading.attr="disabled" class="inline-flex items-center justify-center gap-2 bg-[#07E200] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-[#07E200]/25 hover:bg-[#06c900] hover:shadow-xl hover:shadow-[#07E200]/30 hover:-translate-y-0.5 transition-all disabled:opacity-70 disabled:hover:translate-y-0 disabled:cursor-not-allowed min-w-[140px]">
                                <span wire:loading.remove wire:target="updateProfile">Simpan Profil</span>
                                <span wire:loading wire:target="updateProfile" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
