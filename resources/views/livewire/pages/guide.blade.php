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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Panduan Dashboard</h1>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 space-y-6">
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                    <span class="text-gray-600 font-medium">Bantuan</span>
                </div>

                <div class="bg-[#07E200] rounded-3xl p-6 sm:p-10 relative overflow-hidden flex flex-col items-center text-center">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-black opacity-10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white relative z-10">Halo, Selamat datang di Bantuan Dashboard</h1>
                    <p class="text-white/80 mt-2 mb-8 relative z-10 max-w-lg text-sm sm:text-base">
                        Temukan panduan lengkap untuk menggunakan seluruh fitur di sistem dashboard.
                    </p>
                </div>

                <div class="pt-2">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Pilih Topik Panduan</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

                        <a href="{{ route('guide', ['page' => 'barang']) }}" class="group bg-white border border-gray-100 rounded-2xl p-5 hover:border-[#07E200]/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                            <div class="w-12 h-12 rounded-xl bg-[#07E200]/10 flex items-center justify-center mb-4 text-[#07E200] group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2">Modul Barang</h3>
                            <p class="text-sm text-gray-500 leading-relaxed flex-1">Panduan menambah produk, mengatur stok, mengubah data, dan cetak QR code.</p>

                            <div class="mt-4 flex items-center text-xs font-bold text-[#07E200] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Baca Panduan
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                        </a>

                        <a href="{{ route('guide', ['page' => 'pesanan']) }}" class="group bg-white border border-gray-100 rounded-2xl p-5 hover:border-[#07E200]/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                            <div class="w-12 h-12 rounded-xl bg-[#07E200]/10 flex items-center justify-center mb-4 text-[#07E200] group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2">Modul Pesanan</h3>
                            <p class="text-sm text-gray-500 leading-relaxed flex-1">Cara mengecek riwayat pembayaran, melihat detail transaksi, dan status pesanan.</p>

                            <div class="mt-4 flex items-center text-xs font-bold text-[#07E200] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Baca Panduan
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                        </a>

                        <a href="{{ route('guide', ['page' => 'kategori']) }}" class="group bg-white border border-gray-100 rounded-2xl p-5 hover:border-[#07E200]/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                            <div class="w-12 h-12 rounded-xl bg-[#07E200]/10 flex items-center justify-center mb-4 text-[#07E200] group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2">Modul Kategori</h3>
                            <p class="text-sm text-gray-500 leading-relaxed flex-1">Panduan mengelompokkan jenis barang, mengedit, atau menghapus kategori.</p>

                            <div class="mt-4 flex items-center text-xs font-bold text-[#07E200] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Baca Panduan
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                        </a>

                        <a href="{{ route('guide', ['page' => 'laporan']) }}" class="group bg-white border border-gray-100 rounded-2xl p-5 hover:border-[#07E200]/50 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                            <div class="w-12 h-12 rounded-xl bg-[#07E200]/10 flex items-center justify-center mb-4 text-[#07E200] group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2">Cetak & Laporan</h3>
                            <p class="text-sm text-gray-500 leading-relaxed flex-1">Panduan mengunduh rekap transaksi, mencetak data laporan, dan menyembunyikan header browser saat print.</p>

                            <div class="mt-4 flex items-center text-xs font-bold text-[#07E200] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                Baca Panduan
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                        </a>

                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
