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
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm font-medium px-4 py-3 rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-1.5">
                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                <a href="{{ route('produk') }}" class="hover:text-gray-600 transition-colors">Produk</a>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="9 18 15 12 9 6" />
                                </svg>
                                <p class="text-gray-600 font-medium">{{ $kodeBarang }}</p>
                            </div>
                        </div>
                        <h1 class="text-xl font-extrabold text-gray-900">Detail Produk</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($isEditing)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#F0FDF0] text-[#07E200]"> Mode Edit </span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500"> Mode Lihat </span>
                        @endif

                        @if (!$isEditing)
                            <button wire:click="setMode('edit')" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 text-gray-600 hover:border-[#07E200] hover:text-[#07E200] transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg> Edit Produk
                            </button>
                        @else
                            <button wire:click="setMode('view')" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                                Batal
                            </button>
                            <button wire:click="save" wire:loading.attr="disabled" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                                <svg wire:loading.remove wire:target="save" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                <span wire:loading wire:target="save" class="w-3 h-3 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                Simpan
                            </button>
                        @endif

                        <button wire:click="hapus({{ $idBarang }})" wire:confirm="Hapus produk ini secara permanen?" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-red-200 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2" />
                            </svg> Hapus
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="aspect-square rounded-xl bg-gray-50 flex items-center justify-center mb-4 relative overflow-hidden">
                                @if ($stok == 0)
                                    <div class="absolute top-3 left-0 bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-r-full z-10"> Habis </div>
                                @elseif ($stok <= 10)
                                    <div class="absolute top-3 left-0 text-white text-[10px] font-bold px-3 py-1 rounded-r-full bg-[#F97316] z-10"> Menipis </div>
                                @endif

                                    <div wire:loading.flex class="justify-center py-10">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#07E200]"></div>
                                    </div>
                                @if($imageMode == 'produk')
                                    @if($gambarUrl)
                                        <div wire:loading.remove class="w-full h-full">
                                            @if(count($gambarUrl) > 0)
                                                <div x-data="{ activeSlide: 0, slides: {{ json_encode($gambarUrl) }} }" class="relative w-full h-full group">

                                                    <div class="relative w-full h-full overflow-hidden rounded-xl">
                                                        <template x-for="(slide, index) in slides" :key="index">
                                                            <div x-show="activeSlide === index"
                                                                 x-transition:enter="transition ease-out duration-300"
                                                                 x-transition:enter-start="opacity-0 transform scale-95"
                                                                 x-transition:enter-end="opacity-100 transform scale-100"
                                                                 class="absolute inset-0">
                                                                <img :src="slide" class="w-full h-full object-cover">
                                                            </div>
                                                        </template>
                                                    </div>

                                                    @if(count($gambarUrl) > 1)
                                                        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                                                                class="absolute left-2 top-1/2 -translate-y-1/2 p-1.5 rounded-full bg-white/80 text-gray-700 opacity-0 group-hover:opacity-100 transition-opacity shadow-sm hover:bg-white">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                                        </button>
                                                        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                                                                class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 rounded-full bg-white/80 text-gray-700 opacity-0 group-hover:opacity-100 transition-opacity shadow-sm hover:bg-white">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                                        </button>

                                                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 bg-black/10 backdrop-blur-sm px-2 py-1 rounded-full">
                                                            <template x-for="(slide, index) in slides" :key="index">
                                                                <button @click="activeSlide = index"
                                                                        :class="activeSlide === index ? 'bg-[#07E200] w-4' : 'bg-white/60 w-1.5'"
                                                                        class="h-1.5 rounded-full transition-all duration-300"></button>
                                                            </template>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-yellow-50">
                                                    <svg class="w-16 h-16 text-yellow-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div wire:loading.remove>
                                            <div class="w-28 h-28 rounded-2xl bg-yellow-50 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-yellow-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                @elseif($imageMode == 'qrcode')
                                    <div wire:loading.remove>
                                        <img alt="" src="{{ $gambarQrCode }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div wire:loading.remove>
                                        <div class="w-28 h-28 rounded-2xl bg-yellow-50 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-yellow-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if(!$isEditing)
                                <div class="flex justify-center items-center gap-1">
                                    <div class="bg-gray-100 rounded-xl p-1 flex-shrink-0">
                                        <button
                                            wire:click="changeImageMode('produk')" @class(['p-2 rounded-lg transition-all', 'bg-[#07E200] text-white shadow-sm' => $imageMode === 'produk', 'text-gray-500 hover:text-gray-700' => $imageMode !== 'produk'])>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                            </svg>
                                        </button>
                                        <button
                                            wire:click="changeImageMode('qrcode')" @class(['p-2 rounded-lg transition-all', 'bg-[#07E200] text-white shadow-sm' => $imageMode === 'qrcode', 'text-gray-500 hover:text-gray-700' => $imageMode !== 'qrcode'])>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if ($isEditing)
                                <button class="w-full text-xs font-semibold text-gray-500 border border-dashed border-gray-300 py-2.5 rounded-xl hover:border-[#07E200] hover:text-[#07E200] transition-colors flex items-center justify-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <circle cx="12" cy="13" r="3" />
                                    </svg> Ganti Foto
                                </button>
                            @endif
                        </div>

                        <div class="bg-white border border-gray-100 rounded-2xl p-5 space-y-3">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide pb-3">Status & Penyimpanan</p>

                            @if (!$isEditing)
                                <div class="space-y-2.5">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Status</span>
                                        <span class="text-xs font-bold text-white rounded-lg shadow-sm px-2 py-0.5 @if($status == 'aktif') bg-green-500 @elseif($status == 'nonaktif') bg-red-500 @else bg-yellow-500 @endif">{{ strtoupper($status) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Stok Tersedia</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $stok }} unit</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Lokasi</span>
                                        <span class="text-sm font-bold text-gray-900">{{ $penyimpanan }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="space-y-3">
                                    <div class="space-y-1.5">
                                        <div class="bg-white border border-gray-100 rounded-2xl p-5 space-y-3">
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Status Produk</p>

                                            <div class="space-y-2">
                                                <label wire:click="$set('status', 'aktif')"
                                                       class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all
                                  {{ $status === 'aktif' ? 'border-[#07E200] bg-brand-light' : 'border-gray-200 hover:border-gray-300' }}">
                                                    <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all
                                    {{ $status === 'aktif' ? 'border-[#07E200]' : 'border-gray-300' }}">
                                                        @if ($status === 'aktif')
                                                            <div class="w-2 h-2 rounded-full" style="background:#07E200"></div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-xs font-semibold text-gray-800">Aktif</p>
                                                        <p class="text-[11px] text-gray-400">Produk langsung tampil</p>
                                                    </div>
                                                </label>

                                                <label wire:click="$set('status', 'draft')"
                                                       class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all
                                  {{ $status === 'draft' ? 'border-[#07E200] bg-brand-light' : 'border-gray-200 hover:border-gray-300' }}">
                                                    <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all
                                    {{ $status === 'draft' ? 'border-[#07E200]' : 'border-gray-300' }}">
                                                        @if ($status === 'draft')
                                                            <div class="w-2 h-2 rounded-full" style="background:#07E200"></div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-xs font-semibold text-gray-800">Draft</p>
                                                        <p class="text-[11px] text-gray-400">Simpan, belum tampil</p>
                                                    </div>
                                                </label>

                                                <label wire:click="$set('status', 'nonaktif')"
                                                       class="flex items-center gap-3 p-3 rounded-xl border cursor-pointer transition-all
                                  {{ $status === 'nonaktif' ? 'border-[#07E200] bg-brand-light' : 'border-gray-200 hover:border-gray-300' }}">
                                                    <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all
                                    {{ $status === 'nonaktif' ? 'border-[#07E200]' : 'border-gray-300' }}">
                                                        @if ($status === 'nonaktif')
                                                            <div class="w-2 h-2 rounded-full" style="background:#07E200"></div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-xs font-semibold text-gray-800">Nonaktif</p>
                                                        <p class="text-[11px] text-gray-400">Produk disembunyikan</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-500">Jumlah Stok</label>
                                        <input type="number" wire:model="stok" min="0" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-500">Lokasi Penyimpanan</label>
                                        <input type="text" wire:model="penyimpanan" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <div class="flex items-center justify-between mb-5">
                                <p class="text-sm font-bold text-gray-900">Informasi Utama</p>
                                <span wire:dirty class="text-[10px] font-semibold text-orange-500 bg-orange-50 border border-orange-100 px-2 py-0.5 rounded-full"> Belum disimpan </span>
                            </div>

                            @if (!$isEditing)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div class="sm:col-span-2 space-y-1">
                                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Nama Barang</p>
                                        <p class="text-base font-bold text-gray-900">{{ $nama }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Kode Barang</p>
                                        <p class="text-sm font-mono font-semibold text-gray-700">{{ $kodeBarang }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Kategori</p>
                                        <span class="inline-block text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">{{ $namaKategori }}</span>
                                    </div>
                                    <div class="sm:col-span-2 space-y-1">
                                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Harga</p>
                                        <p class="text-xl font-extrabold text-gray-900">Rp {{ number_format($harga, 0, ',', '.') }}</p>
                                    </div>

                                    <div class="sm:col-span-2 mt-4 pt-4 border-t border-gray-50">
                                        <p class="text-xs font-bold text-gray-900 mb-3">Spesifikasi Produk</p>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                            @foreach($specification as $key => $value)
                                                <div class="space-y-1">
                                                    <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wide">{{ str_replace('_', ' ', $key) }}</p>
                                                    <p class="text-sm font-semibold text-gray-700">{{ $value ?? '-' }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="sm:col-span-2 space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-600">Nama Barang <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model="nama" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                        @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-600">Kategori <span class="text-red-400">*</span></label>
                                        <select wire:model="idKategori" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all">
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategoriList as $kat)
                                                <option value="{{ $kat['id_kategori'] }}">{{ $kat['nama_kategori'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-600">Kode Barang <span class="text-red-400">*</span></label>
                                        <input type="text" wire:model="kodeBarang" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    </div>
                                    <div class="sm:col-span-2 space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-600">Harga Jual <span class="text-red-400">*</span></label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-sm text-gray-400 font-medium">Rp</span>
                                            <input type="number" wire:model="harga" min="0" class="w-full pl-9 pr-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                        </div>
                                        @error('nama') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="sm:col-span-2 mt-6 pt-6 border-t border-gray-100">
                                        <div class="flex items-center justify-between mb-4">
                                            <div>
                                                <p class="text-xs font-bold text-gray-900">Spesifikasi Produk</p>
                                                <p class="text-[10px] text-gray-400">Tambah atribut kustom untuk produk ini</p>
                                            </div>
                                            <button type="button" wire:click="addSpec" class="inline-flex items-center gap-1.5 text-[11px] font-bold text-[#07E200] bg-[#F0FDF0] px-3 py-1.5 rounded-lg hover:bg-[#07E200] hover:text-white transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                    <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                                                </svg>
                                                Tambah Baris
                                            </button>
                                        </div>

                                        <div class="space-y-3">
                                            @foreach($specList as $index => $spec)
                                                <div class="flex flex-col sm:flex-row items-start gap-3 group">
                                                    <div class="flex-1 w-full sm:w-auto">
                                                        <input type="text" wire:model="specList.{{ $index }}.label" placeholder="Nama Atribut (contoh: Bahan)" class="w-full px-3.5 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                                    </div>
                                                    <div class="flex-1 w-full sm:w-auto">
                                                        <input type="text" wire:model="specList.{{ $index }}.value" placeholder="Nilai (contoh: Aluminium)" class="w-full px-3.5 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                                    </div>
                                                    <button type="button" wire:click="removeSpec({{ $index }})" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                            <polyline points="3 6 5 6 21 6" />
                                                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach

                                            @if(count($specList) === 0)
                                                <div class="text-center py-6 border-2 border-dashed border-gray-100 rounded-2xl">
                                                    <p class="text-xs text-gray-400">Belum ada spesifikasi tambahan.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-4">Statistik & Rating</p>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <div class="bg-gray-50 rounded-xl p-3.5 text-center">
                                    <p class="text-xl font-extrabold text-gray-900">{{ $statistik['rating_avg'] ?? '0' }}</p>
                                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">Rating Avg</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-3.5 text-center">
                                    <p class="text-xl font-extrabold text-[#07E200]">{{ $statistik['rating_count'] ?? '0' }}</p>
                                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">Ulasan</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-3.5 text-center">
                                    <p class="text-xl font-extrabold text-gray-900">{{ $stok }}</p>
                                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">Stok Aktif</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-3.5 text-center">
                                    <p class="text-xl font-extrabold text-gray-900">#1</p>
                                    <p class="text-[11px] text-gray-400 font-medium mt-0.5">Populer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
