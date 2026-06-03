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
                    <span class="text-gray-600 font-medium">Panduan Barang</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Panduan Kelola Barang</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Pelajari cara menambah, mengubah, dan mengelola katalog produk di sistem.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#07E200]/10 to-transparent border border-[#07E200]/20 rounded-2xl p-5 sm:p-6 flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm border border-[#07E200]/20">
                        <svg class="w-6 h-6 text-[#07E200]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pusat Bantuan Modul Barang</h2>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Halaman ini berisi panduan lengkap untuk menggunakan fitur-fitur yang ada di halaman Daftar Produk. Klik pada salah satu menu di bawah untuk membaca detailnya.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Cara Menambahkan Produk Baru</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Untuk menambah barang ke database, klik tombol hijau <strong>"+ Tambah Produk"</strong> di pojok kanan atas halaman Daftar Produk. Isi formulir yang disediakan seperti Nama Barang, SKU, Harga, Stok, dan Kategori. Jangan lupa unggah gambar produk agar pelanggan bisa melihatnya di aplikasi.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Pencarian & Filter Kategori</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Gunakan kolom pencarian berikon kaca pembesar untuk mencari barang berdasarkan <strong>Nama</strong> atau kode <strong>SKU</strong>. Di sebelahnya, terdapat menu <em>dropdown</em> untuk memfilter tampilan daftar barang hanya pada <strong>Kategori Tertentu</strong> (contoh: hanya menampilkan poster).
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Mengubah & Menghapus Data</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Pada setiap kartu barang, terdapat tombol <strong>Edit</strong> untuk memperbarui data (seperti mengubah harga atau menambah stok) dan tombol <strong class="text-red-500">Hapus</strong> berwarna merah. Peringatan: Data yang telah dihapus tidak dapat dikembalikan dan mungkin memengaruhi riwayat transaksi masa lalu.
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
                                    <svg class="w-4 h-4" :class="expanded ? 'text-[#07E200]' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2" /><rect x="7" y="7" width="3" height="3" /><rect x="14" y="7" width="3" height="3" /><rect x="7" y="14" width="3" height="3" /><rect x="14" y="14" width="3" height="3" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800">Cetak Barcode & Tampilan Layout</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Kamu bisa mencetak seluruh QR Code barang sekaligus untuk ditempelkan di rak toko dengan mengeklik ikon <strong>Printer</strong> di atas daftar pencarian. Selain itu, kamu bisa mengubah mode tampilan dari kartu (Grid) menjadi tabel bersusun (List) menggunakan ikon tombol kotak-kotak di sebelah kolom filter kategori.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
