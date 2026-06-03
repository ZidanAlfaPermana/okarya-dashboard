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
                    <span class="text-gray-600 font-medium">Panduan Kategori</span>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Panduan Kelola Kategori</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Pelajari cara mengelompokkan barang agar lebih rapi dan mudah dicari oleh pelanggan.
                        </p>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-[#07E200]/10 to-transparent border border-[#07E200]/20 rounded-2xl p-5 sm:p-6 flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 shadow-sm border border-[#07E200]/20">
                        <svg class="w-6 h-6 text-[#07E200]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Pusat Bantuan Modul Kategori</h2>
                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                            Kategori berfungsi sebagai "folder" untuk produkmu. Pengelompokan yang baik akan sangat membantu pelanggan menemukan barang yang mereka inginkan. Klik menu di bawah untuk panduan lengkapnya.
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
                                <span class="text-sm font-bold text-gray-800">Cara Membuat Kategori Baru</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Untuk membuat kategori baru, klik tombol <strong>"+ Tambah Kategori"</strong> di halaman daftar kategori. Kamu hanya perlu mengisi <strong>Nama Kategori</strong> (misal: "Poster Edisi Terbatas") dan memberikan deskripsi singkat agar staf atau pelanggan tahu isi kategori tersebut.
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
                                <span class="text-sm font-bold text-gray-800">Mengubah Data (Edit) Kategori</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Klik tombol berikon <strong>Pensil (Edit)</strong> pada baris kategori yang ingin diubah. Mengubah nama kategori di sini akan <strong class="text-gray-900">otomatis memperbarui</strong> label kategori pada semua barang yang sudah tertaut dengan kategori ini. Kamu tidak perlu mengubah barangnya satu per satu.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ expanded: false }"
                         class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm transition-all duration-200"
                         :class="expanded ? 'ring-1 ring-[#07E200]/50 border-[#07E200]/50' : 'hover:border-gray-200'">
                        <button @click="expanded = !expanded" class="w-full flex items-center justify-between p-4 sm:p-5 outline-none">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center border border-gray-100" :class="expanded ? 'bg-red-50 border-red-100' : ''">
                                    <svg class="w-4 h-4" :class="expanded ? 'text-red-500' : 'text-gray-500'" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </div>
                                <span class="text-sm font-bold text-gray-800" :class="expanded ? 'text-red-600' : ''">Peringatan Menghapus Kategori</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-red-500' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-red-50 rounded-xl border border-red-100 text-sm text-red-800 leading-relaxed">
                                    <strong>Hati-hati!</strong> Sebelum menghapus kategori menggunakan tombol <strong class="text-red-600">Tong Sampah Merah</strong>, pastikan <span class="underline">tidak ada barang yang sedang menggunakan kategori tersebut</span>. Menghapus kategori yang masih memiliki barang di dalamnya dapat menyebabkan data barang menjadi *error* atau kehilangan klasifikasinya.
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
                                <span class="text-sm font-bold text-gray-800">Mencari Kategori Spesifik</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="expanded ? 'rotate-180 text-[#07E200]' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" /></svg>
                        </button>
                        <div x-show="expanded" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                            <div class="px-4 sm:px-5 pb-4 sm:pb-5">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100 text-sm text-gray-600 leading-relaxed">
                                    Jika datamu sudah sangat banyak, kamu tidak perlu mencari secara manual dari halaman ke halaman. Gunakan <strong>Kolom Pencarian</strong> di atas tabel. Cukup ketikkan kata kunci dari nama kategori (misal: "baju"), dan sistem otomatis akan memfilter data yang relevan secara <em>real-time</em>.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
