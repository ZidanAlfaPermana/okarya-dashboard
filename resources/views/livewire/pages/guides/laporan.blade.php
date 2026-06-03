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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Panduan Barang</h1>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 space-y-6">
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                    <a href="{{ route('guide') }}" class="hover:text-gray-600 transition-colors cursor-pointer">Bantuan</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                    <span class="text-gray-600 font-medium">Panduan Cetak & Laporan</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Panduan Cetak & Laporan</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Pelajari cara merekap data, mencetak laporan fisik, dan menyimpan dokumen ke format digital.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#07E200]/10 to-transparent border border-[#07E200]/20 rounded-2xl p-5 sm:p-6 flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm border border-[#07E200]/20">
                        <svg class="w-6 h-6 text-[#07E200]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pusat Bantuan Cetak Dokumen</h2>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Modul ini sangat penting untuk keperluan pembukuan. Kamu bisa mencetak riwayat pesanan, struk transaksi, dan laporan pendapatan. Simak panduannya di bawah agar hasil cetakmu rapi.
                        </p>
                    </div>
                </div>

                <div class="space-y-3">

                    <div x-data="{ expanded: false }"
                         class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm transition-all duration-200"
                         :class="expanded ? 'ring-1 ring-[#07E200]/50 border-[#07E200]/50' : 'hover:border-gray-200'">
                        <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-4 sm:p-5 outline-none">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100" :class="expanded ? 'bg-[#07E200]/10 border-[#07E200]/20' : ''">
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Menyaring Laporan Berdasarkan Tanggal</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Sebelum menekan tombol cetak, pastikan kamu sudah memfilter data yang ingin dicetak. Kamu bisa menggunakan <strong>Filter Tanggal (Dari - Sampai)</strong> untuk mencetak laporan khusus hari ini, minggu lalu, atau pembukuan bulan tertentu agar datanya tidak bercampur.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }"
                         class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm transition-all duration-200"
                         :class="expanded ? 'ring-1 ring-[#07E200]/50 border-[#07E200]/50' : 'hover:border-gray-200'">
                        <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-4 sm:p-5 outline-none">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100" :class="expanded ? 'bg-[#07E200]/10 border-[#07E200]/20' : ''">
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Tips: Menghilangkan Tulisan Link di Kertas</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed space-y-3">
                                    <p>Jika saat mencetak muncul teks aneh (seperti tanggal, nomor halaman, atau link URL localhost) di bagian atas/bawah kertasmu, itu adalah bawaan dari browser. Cara menghilangkannya:</p>
                                    <ul class="list-decimal pl-5 space-y-1 mt-2 text-gray-700">
                                        <li>Tekan tombol cetak atau <strong>Ctrl + P</strong>.</li>
                                        <li>Pada jendela Google Chrome/Edge, klik menu <strong>More settings</strong> (Pengaturan lainnya).</li>
                                        <li>Scroll ke bawah lalu <strong class="text-gray-900">hilangkan centang pada opsi "Headers and footers"</strong>.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }"
                         class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm transition-all duration-200"
                         :class="expanded ? 'ring-1 ring-[#07E200]/50 border-[#07E200]/50' : 'hover:border-gray-200'">
                        <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-4 sm:p-5 outline-none">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100" :class="expanded ? 'bg-[#07E200]/10 border-[#07E200]/20' : ''">
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Menyimpan Laporan sebagai PDF</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Kamu tidak harus menggunakan kertas fisik. kamu bisa mengekspornya ke dalam format PDF. Caranya sangat mudah: klik tombol Cetak (Print), kemudian pada kolom <strong>Destination (Tujuan)</strong>, ubah nama printer-mu menjadi <strong>"Save as PDF"</strong>. Lalu klik Simpan.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
