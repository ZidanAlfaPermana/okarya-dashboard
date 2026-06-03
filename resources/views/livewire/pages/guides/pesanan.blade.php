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
                    <span class="hover:text-gray-600 transition-colors cursor-pointer">Pusat Bantuan</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                    <span class="text-gray-600 font-medium">Panduan Pesanan</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Panduan Kelola Pesanan</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Pelajari cara memantau riwayat transaksi, melacak pembayaran, dan melihat detail struk pesanan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#07E200]/10 to-transparent border border-[#07E200]/20 rounded-2xl p-5 sm:p-6 flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm border border-[#07E200]/20">
                        <svg class="w-6 h-6 text-[#07E200]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pusat Bantuan Modul Pesanan</h2>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Modul pesanan (Riwayat Pembayaran) mencatat seluruh alur transaksi secara otomatis. Di sini kamu bisa melacak status pembayaran pelanggan dari awal hingga selesai.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Pencarian Kode Transaksi (TRX)</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Jika ada pelanggan yang komplain atau menanyakan status pesanannya, mintalah <strong>Kode Transaksi</strong> mereka (contoh: <code>TRX-12345-XXXXX</code>). Masukkan kode tersebut atau 5 angka tengahnya ke dalam kolom pencarian di bagian atas tabel, lalu sistem akan langsung memunculkan struk pesanan yang dicari.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Memahami Label Warna Status Transaksi</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed space-y-3">
                                    <p>Sistem menggunakan kode warna agar kamu bisa mengenali status pembayaran dengan cepat:</p>
                                    <ul class="space-y-2 mt-2">
                                        <li class="flex items-center gap-2">
                                            <span class="bg-[#F0FDF0] text-[#07E200] text-[10px] uppercase tracking-wide font-bold px-2.5 py-1 rounded-full w-24 text-center">Settlement</span>
                                            <span>: Pembayaran telah <strong class="text-gray-900">sukses</strong> diterima. Barang siap diproses.</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="bg-orange-100 text-orange-600 text-[10px] uppercase tracking-wide font-bold px-2.5 py-1 rounded-full w-24 text-center">Pending</span>
                                            <span>: Pelanggan sudah *checkout* tapi <strong class="text-gray-900">belum mentransfer</strong> uangnya.</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="bg-red-100 text-red-600 text-[10px] uppercase tracking-wide font-bold px-2.5 py-1 rounded-full w-24 text-center">Expire</span>
                                            <span>: Batas waktu pembayaran habis. Transaksi otomatis dibatalkan.</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="bg-red-100 text-red-600 text-[10px] uppercase tracking-wide font-bold px-2.5 py-1 rounded-full w-24 text-center">Cancel</span>
                                            <span>: Pelanggan secara manual membatalkan transaksi tersebut.</span>
                                        </li>
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Menyaring (Filter) Data Pesanan</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Jika kamu hanya ingin melihat daftar orang yang sudah sukses membayar hari ini, gunakan menu <em>Dropdown</em> di sebelah kanan kotak pencarian. Ubah opsi dari <strong>"Semua Status"</strong> menjadi <strong>"Settlement / Sukses"</strong>. Tabel otomatis hanya akan menampilkan data yang kamu pilih.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Melihat Rincian Barang yang Dibeli</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Tabel utama hanya menampilkan ringkasan pembayaran (Nama, Tanggal, Total, Status). Untuk melihat <strong>barang apa saja yang dibeli</strong> oleh pelanggan tersebut, klik tombol berikon <strong>Mata (Lihat Detail)</strong> berwarna biru pada kolom Aksi. Kamu akan diarahkan ke halaman rincian invoice/struk secara penuh.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
