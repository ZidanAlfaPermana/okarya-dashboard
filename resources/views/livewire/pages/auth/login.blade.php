<div class="font-sans bg-gray-50 min-h-screen">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-[52%] flex-col justify-between p-12 relative overflow-hidden" style="background: linear-gradient(145deg, #0a0a0a 0%, #111 60%, #0d2200 100%)">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full opacity-20" style="background: radial-gradient(circle, #07E200, transparent 70%)"></div>
            <div class="absolute -bottom-32 -right-16 w-[500px] h-[500px] rounded-full opacity-10" style="background: radial-gradient(circle, #07E200, transparent 70%)"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-5" style="background: radial-gradient(circle, #07E200, transparent 60%)"></div>
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                    <img src="https://www.smkn5malang.sch.id/storage/img/logo.png" class="bg-cover bg-no-repeat" alt="">
                </div>
                <span class="text-white font-extrabold text-xl tracking-tight">Toko Vohisma</span>
            </div>
            <div class="relative z-10 space-y-6">
                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/10 rounded-full px-4 py-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#07E200]"></span>
                    <span class="text-white/70 text-xs font-medium">Platform Toko barang</span>
                </div>
                <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight"> Kelola toko <br />
                    <span class="text-[#07E200]">lebih mudah</span>
                    <br /> dari mana saja.
                </h1>
                <p class="text-white/50 text-sm leading-relaxed max-w-sm"> Dashboard lengkap untuk manajemen produk, pesanan, stok, dan pelanggan toko barang kamu dalam satu tempat. </p>
            </div>
            <p class="relative z-10 text-white/25 text-xs">© 2025 SMKN 5 Malang. All rights reserved.</p>
        </div>
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="flex items-center gap-2 mb-10 lg:hidden">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-[#07E200]">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="font-extrabold text-gray-900 text-lg">Toko Vohisma</span>
                </div>
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Selamat datang kembali</h2>
                    <p class="text-gray-400 text-sm mt-1.5">Masuk ke akun Toko Vohisma kamu untuk melanjutkan</p>
                </div>
                <form wire:submit="login" class="space-y-5">
                    <div class="space-y-1.5">
                        <label class="text-sm font-semibold text-gray-700">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input wire:model="form.email" name="email" type="email" placeholder="admin@tokoku.id" class="w-full pl-10 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-white text-gray-800 placeholder-gray-400 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 transition-all" />
                        </div>
                        @error('form.email')
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-1.5" x-data="{ show: false }">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-gray-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4" />
                                </svg>
                            </div>
                            <input wire:model="form.password" name="password" :type="show ? 'text' : 'password'" placeholder="••••••••" class="w-full pl-10 pr-12 py-3 text-sm border border-gray-200 rounded-xl bg-white text-gray-800 placeholder-gray-400 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 transition-all" />
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-pwd" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path x-show="!show" stroke-linecap="round" stroke-linejoin="round" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle x-show="!show" cx="12" cy="12" r="3" />
                                    <path x-show="show" stroke-linecap="round" stroke-linejoin="round" d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/>
                                    <line x-show="show" x1="1" y1="1" x2="23" y2="23" stroke-linecap="round"/>`;
                                </svg>
                            </button>
                        </div>
                        @error('form.password')
                        <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full py-3 rounded-xl text-sm font-bold text-white transition-all hover:opacity-90 active:scale-[.98] flex items-center justify-center gap-2 bg-[#07E200]"> Masuk ke Dashboard <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
