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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard Produk</h1>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 space-y-6">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Daftar QR Code</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $produk->total() }} QR Code ditemukan di database
                        </p>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('produk.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-white px-4 py-2.5 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                            </svg> Tambah QR Code
                        </a>
                        <a href="{{ route('produk.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#07E200] hover:text-white px-4 py-2.5 rounded-xl border border-[#07E200] hover:opacity-90 hover:bg-[#07E200] transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                            Print Form
                        </a>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau SKU..." class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 transition-all" />
                    </div>

                    <select wire:model.live="searchBy" class="text-sm border border-gray-200 rounded-xl bg-gray-50 px-3 py-2.5 outline-none focus:border-[#07E200] sm:w-44">
                        <option value="nama_barang">Nama Barang</option>
                        <option value="kode_barang">Kode Barang</option>
                    </select>

                    <select wire:model.live="kategori" class="text-sm border border-gray-200 rounded-xl bg-gray-50 px-3 py-2.5 outline-none focus:border-[#07E200] sm:w-44">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat['id_kategori'] }}">{{ $kat['nama_kategori'] }}</option>
                        @endforeach
                    </select>

                    <div class="flex items-center gap-1 bg-gray-100 rounded-xl p-1 flex-shrink-0">
                        <button wire:click="toggleView('card')" @class(['p-2 rounded-lg transition-all', 'bg-[#07E200] text-white shadow-sm' => $viewMode === 'card', 'text-gray-500 hover:text-gray-700' => $viewMode !== 'card'])>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="1" /><rect x="14" y="3" width="7" height="7" rx="1" /><rect x="3" y="14" width="7" height="7" rx="1" /><rect x="14" y="14" width="7" height="7" rx="1" />
                            </svg>
                        </button>
                        <button wire:click="toggleView('list')" @class(['p-2 rounded-lg transition-all', 'bg-[#07E200] text-white shadow-sm' => $viewMode === 'list', 'text-gray-500 hover:text-gray-700' => $viewMode !== 'list'])>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <line x1="3" y1="6" x2="21" y2="6" /><line x1="3" y1="12" x2="21" y2="12" /><line x1="3" y1="18" x2="21" y2="18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div wire:loading.flex class="justify-center py-10">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#07E200]"></div>
                </div>

                <div wire:loading.remove>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse ($qrcode as $item)
                            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden hover:-translate-y-1 transition-transform duration-200 group">
                                <div class="relative h-40 bg-gray-50 flex items-center justify-center overflow-hidden">
                                    @if($item['stok'] > 10)
                                        <span class="absolute top-3 left-3 z-10 text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-600">Tersedia</span>
                                    @elseif($item['stok'] > 0)
                                        <span class="absolute top-3 left-3 z-10 text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-100 text-orange-600">Menipis</span>
                                    @else
                                        <span class="absolute top-3 left-3 z-10 text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-500">Habis</span>
                                    @endif

                                    <span class="absolute top-3 right-3 z-10 text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/80 backdrop-blur-sm text-gray-500 border border-gray-100">
                                            {{ $item['kategori']['nama_kategori'] ?? 'No Category' }}
                                        </span>

                                    @if($item['gambar'] ?? false)
                                        <img src="{{ $item['gambar'][0]['gambar'] }}" alt="{{ $item['nama_barang'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $item['nama_barang'] }}</p>
                                    <p class="text-[11px] text-gray-400 mt-0.5">SKU: {{ $item['kode_barang'] }}</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <p class="text-base font-extrabold text-gray-900">Rp {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                        <span class="text-xs text-gray-500 font-medium">Stok: {{ $item['stok'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-4 pt-3 border-t border-gray-50">
                                        <a href="{{ url('produk/detail/'.$item['kode_barang']) }}" class="flex-1 text-center text-xs font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 py-2 rounded-lg transition-colors">Edit</a>
                                        <button
                                            wire:click="hapus('{{ $item['id_barang'] }}')"
                                            wire:confirm="Apakah Anda yakin ingin menghapus produk ini?"
                                            class="flex-1 text-center text-xs font-semibold text-red-500 bg-red-50 hover:bg-red-100 py-2 rounded-lg transition-colors"
                                        >Hapus</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col col-span-full pt-10 justify-center items-center text-center gap-2 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                </svg>
                                <h3 class="col-span-full text-gray-500 text-2xl">Barang Kosong</h3>
                                <p class="col-span-full text-gray-400">Tidak ada QR Code yang ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-6">
                        {{ $produk->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
