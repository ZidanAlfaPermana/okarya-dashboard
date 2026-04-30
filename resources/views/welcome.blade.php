<div class="font-sans bg-gray-50 text-gray-800 h-screen overflow-hidden">
    <div id="overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden"></div>
    <div class="flex h-screen">
        <x-sidebar></x-sidebar>
        <div class="flex-1 flex flex-col min-w-0 md:ml-0 overflow-y-auto">
            <header class="sticky top-0 z-10 bg-white border-b border-gray-100 px-4 sm:px-6 py-3.5 flex items-center gap-4">
                <button id="openSide" class="md:hidden p-1.5 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex-1">
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard</h1>
                    <p class="text-xs text-gray-400 hidden sm:block">Selamat datang kembali, {{ auth()->user()->name }}</p>
                </div>
                <a class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold" style="background:#07E200"> {{ substr(auth()->user()->name, 0, 1) }} </a>
            </header>
            <main class="flex-1 p-4 sm:p-6 space-y-6">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-5 hover:-translate-y-1 transition-transform duration-200 cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#F0FDF0">
                                <svg class="w-5 h-5" fill="none" stroke="#07E200" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14l-4-4 1.41-1.41L11 13.17l6.59-6.59L19 8l-8 8z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">+12%</span>
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">Rp 4,2jt</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Pendapatan</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-5 hover:-translate-y-1 transition-transform duration-200 cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#FFF7ED">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-orange-500 bg-orange-50 px-2 py-0.5 rounded-full">+5%</span>
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">138</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Pesanan</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-5 hover:-translate-y-1 transition-transform duration-200 cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">+8%</span>
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">94</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Kategori</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-5 hover:-translate-y-1 transition-transform duration-200 cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-red-50">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-red-500 bg-red-50 px-2 py-0.5 rounded-full">-3%</span>
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">312</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Produk</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-sm font-bold text-gray-900">Ringkasan Penjualan</h2>
                                <p class="text-xs text-gray-400">7 hari terakhir</p>
                            </div>
                            <div class="flex gap-1.5">
                                <button class="text-xs font-semibold text-white px-3 py-1.5 rounded-lg" style="background:#07E200">Minggu</button>
                                <button class="text-xs font-medium text-gray-500 px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors">Bulan</button>
                            </div>
                        </div>
                        <div class="flex items-end gap-2 h-40 mb-3">
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">320rb</span>
                                <div class="w-full rounded-t-lg" style="height:37%;background:#07E200;opacity:0.7"></div>
                                <span class="text-[10px] text-gray-400">Sen</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">580rb</span>
                                <div class="w-full rounded-t-lg" style="height:67%;background:#07E200;opacity:0.8"></div>
                                <span class="text-[10px] text-gray-400">Sel</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">420rb</span>
                                <div class="w-full rounded-t-lg" style="height:49%;background:#07E200;opacity:0.7"></div>
                                <span class="text-[10px] text-gray-400">Rab</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">710rb</span>
                                <div class="w-full rounded-t-lg" style="height:82%;background:#07E200"></div>
                                <span class="text-[10px] text-gray-400">Kam</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">490rb</span>
                                <div class="w-full rounded-t-lg" style="height:57%;background:#07E200;opacity:0.75"></div>
                                <span class="text-[10px] text-gray-400">Jum</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] font-semibold" style="color:#07E200">860rb</span>
                                <div class="w-full rounded-t-lg" style="height:100%;background:#07E200"></div>
                                <span class="text-[10px] text-gray-400">Sab</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <span class="text-[10px] text-gray-400 font-medium">640rb</span>
                                <div class="w-full rounded-t-lg" style="height:74%;background:#07E200;opacity:0.8"></div>
                                <span class="text-[10px] text-gray-400">Min</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400">Total Minggu Ini</p>
                                <p class="text-lg font-extrabold text-gray-900">Rp 4.020.000</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">Rata-rata / Hari</p>
                                <p class="text-lg font-extrabold text-gray-900">Rp 574.000</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">Hari Terbaik</p>
                                <p class="text-lg font-extrabold" style="color:#07E200">Sabtu</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Produk Terlaris</h2>
                            <a href="#" class="text-xs font-semibold" style="color:#07E200">Lihat semua</a>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-yellow-50 flex-shrink-0">
                                    <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Pensil 2B Faber</p>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                            <div class="h-full rounded-full" style="width:85%;background:#07E200"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium">85%</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900 flex-shrink-0">230</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-blue-50 flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Buku Tulis Sidu</p>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-blue-400" style="width:72%"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium">72%</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900 flex-shrink-0">185</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-purple-50 flex-shrink-0">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Pulpen Pilot G2</p>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-purple-400" style="width:60%"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium">60%</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900 flex-shrink-0">154</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-pink-50 flex-shrink-0">
                                    <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Penggaris 30cm</p>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-pink-400" style="width:45%"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium">45%</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900 flex-shrink-0">112</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-orange-50 flex-shrink-0">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Tas Ransel Polo</p>
                                    <div class="flex items-center gap-1 mt-0.5">
                                        <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-orange-400" style="width:38%"></div>
                                        </div>
                                        <span class="text-[10px] text-gray-400 font-medium">38%</span>
                                    </div>
                                </div>
                                <p class="text-sm font-bold text-gray-900 flex-shrink-0">98</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Pesanan Terbaru</h2>
                            <a href="#" class="text-xs font-semibold" style="color:#07E200">Lihat semua</a>
                        </div>
                        <div class="overflow-x-auto -mx-5 px-5">
                            <table class="w-full min-w-[480px]">
                                <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">ID</th>
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">Pelanggan</th>
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5 hidden sm:table-cell">Produk</th>
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">Total</th>
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">Status</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-xs font-mono text-gray-400">#1042</td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0" style="background:#07E200">BU</div>
                                            <span class="text-sm font-medium text-gray-800">Budi U.</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">Pensil + Buku (3x)</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900">Rp 45.000</td>
                                    <td class="py-3">
                                        <span class="text-[11px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Selesai</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-xs font-mono text-gray-400">#1041</td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold bg-blue-400 flex-shrink-0">SR</div>
                                            <span class="text-sm font-medium text-gray-800">Sari R.</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">Tas Ransel (1x)</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900">Rp 120.000</td>
                                    <td class="py-3">
                                        <span class="text-[11px] font-semibold text-orange-500 bg-orange-50 px-2 py-1 rounded-full">Diproses</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-xs font-mono text-gray-400">#1040</td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold bg-purple-400 flex-shrink-0">AN</div>
                                            <span class="text-sm font-medium text-gray-800">Agus N.</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">Pulpen + Penggaris</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900">Rp 28.500</td>
                                    <td class="py-3">
                                        <span class="text-[11px] font-semibold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Dikirim</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-xs font-mono text-gray-400">#1039</td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold bg-pink-400 flex-shrink-0">DW</div>
                                            <span class="text-sm font-medium text-gray-800">Dewi W.</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">Buku Gambar (5x)</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900">Rp 62.000</td>
                                    <td class="py-3">
                                        <span class="text-[11px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Selesai</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 text-xs font-mono text-gray-400">#1038</td>
                                    <td class="py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold bg-yellow-400 flex-shrink-0">RH</div>
                                            <span class="text-sm font-medium text-gray-800">Rudi H.</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">Cat Air + Kuas</td>
                                    <td class="py-3 text-sm font-semibold text-gray-900">Rp 87.000</td>
                                    <td class="py-3">
                                        <span class="text-[11px] font-semibold text-red-500 bg-red-50 px-2 py-1 rounded-full">Dibatalkan</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Stok Menipis</h2>
                            <span class="text-xs font-bold text-white px-2 py-0.5 rounded-full bg-red-400">5 item</span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl border border-red-100">
                                <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Mistar Besi 50cm</p>
                                    <p class="text-xs text-red-500 font-medium">Sisa 3 pcs</p>
                                </div>
                                <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restock</button>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl border border-red-100">
                                <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M12 8l4 4-4 4" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Krayon 24 Warna</p>
                                    <p class="text-xs text-red-500 font-medium">Sisa 5 pcs</p>
                                </div>
                                <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restock</button>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-xl border border-orange-100">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Stapler Kecil</p>
                                    <p class="text-xs text-orange-500 font-medium">Sisa 8 pcs</p>
                                </div>
                                <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restock</button>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-xl border border-orange-100">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Gunting Besar</p>
                                    <p class="text-xs text-orange-500 font-medium">Sisa 10 pcs</p>
                                </div>
                                <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restock</button>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-orange-50 rounded-xl border border-orange-100">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate">Klip Kertas</p>
                                    <p class="text-xs text-orange-500 font-medium">Sisa 12 pcs</p>
                                </div>
                                <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restock</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4" style="background:linear-gradient(135deg,#07E200 0%,#05B800 100%)">
                    <div>
                        <p class="text-white font-extrabold text-lg leading-tight">Tambah Produk Baru?</p>
                        <p class="text-green-100 text-sm mt-0.5">Lengkapi stok toko kamu sekarang agar pelanggan makin puas!</p>
                    </div>
                    <a href="{{ route('produk.create') }}" class="flex-shrink-0 bg-white font-bold text-sm px-5 py-2.5 rounded-xl shadow hover:shadow-md hover:scale-105 transition-all duration-200 ease-in-out flex items-center gap-2" style="color:#07E200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg> Tambah Produk </a>
                </div>
            </main>
        </div>
    </div>
</div>
