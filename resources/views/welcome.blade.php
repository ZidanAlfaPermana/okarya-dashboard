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
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">Rp {{ number_format($data['kpi']['pendapatan']['total'], 0, 1) }}</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Pendapatan</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-5 hover:-translate-y-1 transition-transform duration-200 cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:#FFF7ED">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $data['kpi']['pesanan']['total'] }}</p>
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
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $data['kpi']['kategori']['total'] }}</p>
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
                        </div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $data['kpi']['produk']['total'] }}</p>
                        <p class="text-xs text-gray-400 mt-1 font-medium">Total Produk</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
                        @include('components.pesanan_charts', ['grafik' => $grafik])
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Produk Terlaris</h2>
                            <a href="{{ route('produk') }}" class="text-xs font-semibold" style="color:#07E200">Lihat semua</a>
                        </div>
                        <div class="space-y-3">
                            @foreach($data['produk_terlaris'] as $datas)
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-yellow-50 flex-shrink-0">
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $datas['nama_barang'] }}</p>
                                        <div class="flex items-center gap-1 mt-0.5">
                                            <div class="h-1.5 rounded-full flex-1 bg-gray-100 overflow-hidden">
                                                <div class="h-full rounded-full" style="width:{{ $datas['persentase'] }}%;background:#07E200"></div>
                                            </div>
                                            <span class="text-[10px] text-gray-400 font-medium">{{ $datas['persentase'] }}%</span>
                                        </div>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900 flex-shrink-0">{{ $datas['total'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5">
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Pesanan Terbaru</h2>
                            <a href="{{ route('pesanan') }}" class="text-xs font-semibold" style="color:#07E200">Lihat semua</a>
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
                                @foreach($data['pesanan_terbaru'] as $datas)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-3 text-xs font-mono text-gray-400">{{ $datas['kode_transaksi'] }}</td>
                                        <td class="py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0" style="background:#07E200">{{ substr($datas['pelanggan'], 0, 1) }}</div>
                                                <span class="text-sm font-medium text-gray-800">{{ $datas['pelanggan'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 text-xs text-gray-500 hidden sm:table-cell">{{ $datas['produk'] }}</td>
                                        <td class="py-3 text-sm font-semibold text-gray-900">Rp {{ number_format($datas['total'], 0, 1) }}</td>
                                        <td class="py-3">
                                            <span class="text-[11px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">{{ $datas['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Stok Menipis</h2>
                            <span class="text-xs font-bold text-white px-2 py-0.5 rounded-full bg-red-400">{{ count($data['stok_menipis']) }} item</span>
                        </div>
                        <div class="space-y-3">
                            @foreach($data['stok_menipis'] as $datas)
                                <div @class(['flex', 'items-cente', 'gap-3', 'p-3', 'bg-red-50' => $datas['stok'] <= 5, 'bg-orange-50' => $datas['stok'] > 5, 'rounded-xl', 'border', 'border-red-100' => $datas['stok'] <= 5, 'border-orange-100' => $datas['stok'] > 5])>
                                    <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $datas['nama_barang'] }}</p>
                                        <p class="text-xs text-red-500 font-medium">Sisa {{ $datas['stok'] }} pcs</p>
                                    </div>
                                    <button class="text-xs font-semibold text-white px-2.5 py-1 rounded-lg flex-shrink-0" style="background:#07E200">Restok</button>
                                </div>
                            @endforeach
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
