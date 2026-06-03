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
                            @forelse($data['produk_terlaris'] as $datas)
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
                            @empty
                                <div class="flex flex-col col-span-full pt-10 justify-center items-center text-center gap-2 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cart-check size-8 text-gray-500" viewBox="0 0 16 16">
                                        <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                    <h3 class="col-span-full text-gray-500 text-2xl">Pesanan Kosong</h3>
                                    <p class="col-span-full text-gray-400">Tidak ada pesanan yang ditemukan.</p>
                                </div>
                            @endforelse
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
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">Total</th>
                                    <th class="text-left text-[11px] font-semibold text-gray-400 uppercase tracking-wide pb-2.5">Status</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                @foreach($data['pesanan_terbaru'] as $datas)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-3 text-xs font-mono text-gray-400"><a href="{{ url('pesanan/detail/'.$datas['kode_transaksi']) }}" class="hover:underline">{{ $datas['kode_transaksi'] }}</a></td>
                                        <td class="py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-7 h-7 rounded-full text-white flex items-center justify-center text-[10px] font-bold flex-shrink-0" style="background:#07E200">{{ substr($datas['pelanggan'], 0, 1) }}</div>
                                                <span class="text-sm font-medium text-gray-800">{{ $datas['pelanggan'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 text-sm font-semibold text-gray-900">Rp {{ number_format($datas['total'], 0, 1) }}</td>
                                        <td class="py-3">
                                            <span class="text-[11px] font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">{{ $datas['status'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @empty($data['pesanan_terbaru'])
                                <div class="flex flex-col col-span-full pt-10 justify-center items-center text-center gap-2 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    <h3 class="col-span-full text-gray-500 text-2xl">Pesanan Kosong</h3>
                                    <p class="col-span-full text-gray-400">Tidak ada pesanan yang ditemukan.</p>
                                </div>
                            @endempty
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-gray-100 p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-900">Stok Menipis</h2>
                            <span class="text-xs font-bold text-white px-2 py-0.5 rounded-full bg-red-400">{{ count($data['stok_menipis']) }} item</span>
                        </div>
                        <div class="space-y-3">
                            @forelse($data['stok_menipis'] as $datas)
                                <div @class(['flex', 'items-center', 'gap-3', 'p-3', 'bg-red-50' => $datas['stok'] <= 5, 'bg-orange-50' => $datas['stok'] > 5, 'rounded-xl', 'border', 'border-red-100' => $datas['stok'] <= 5, 'border-orange-100' => $datas['stok'] > 5])>
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
                                    <a href="{{ url('produk/detail/'.$datas['kode_barang']) }}" class="text-xs font-semibold text-white px-2 w-fit h-8 flex items-center rounded-lg flex-shrink-0" style="background:#07E200">Restok</a>
                                </div>
                            @empty
                                <div class="flex flex-col col-span-full pt-10 justify-center items-center text-center gap-2 w-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bookmark-check size-8 text-gray-500" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                                    </svg>
                                    <h3 class="col-span-full text-gray-500 text-xl">Barang Terpenuhi</h3>
                                    <p class="col-span-full text-gray-400 text-sm">Mungkin barang kosong atau stok sudah terisi.</p>
                                </div>
                            @endforelse
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
