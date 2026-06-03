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
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-600 text-sm font-medium px-4 py-3 rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                            <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <a href="{{ route('produk') }}" class="hover:text-gray-600 transition-colors">Produk</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <p class="text-gray-600 font-medium">Tambah Produk</p>
                        </div>
                        <h1 class="text-xl font-extrabold text-gray-900">Tambah Produk Baru</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('produk') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                            <svg wire:loading.remove wire:target="save" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span wire:loading wire:target="save" class="w-3 h-3 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            Simpan Produk
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6" x-data="{ activeIndex: 0 }">

                            <div class="aspect-square rounded-xl bg-gray-50 flex items-center justify-center mb-4 relative overflow-hidden border-2 border-dashed border-gray-200">

                                @if(count($gambar) === 0)
                                    <div class="text-center p-4">
                                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-[10px] font-medium text-gray-400">Preview Foto Produk</p>
                                    </div>
                                @else
                                    @foreach($gambar as $index => $img)
                                        <div x-show="activeIndex === {{ $index }}" class="absolute inset-0 w-full h-full transition-opacity duration-300">
                                            <img src="{{ $img->temporaryUrl() }}"
                                                 class="w-full h-full object-cover"
                                                 alt="Preview {{ $index }}">

                                            <button type="button"
                                                    wire:click="removeGambar({{ $index }})"
                                                    @click="activeIndex = 0"
                                                    class="absolute top-2 right-2 p-1.5 bg-white/80 backdrop-blur-sm hover:bg-red-500 text-gray-700 hover:text-white rounded-lg shadow-sm border border-gray-200 transition-all z-10"
                                                    title="Hapus gambar ini">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach

                                    <div wire:loading wire:target="gambar" class="absolute inset-0 bg-white/60 backdrop-blur-sm flex flex-col items-center justify-center z-10">
                                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#07E200] mb-2"></div>
                                        <p class="text-xs font-bold text-gray-600">Menyiapkan gambar...</p>
                                    </div>
                                @endif
                            </div>

                            @if(count($gambar) > 0)
                                <div class="flex gap-2 overflow-x-auto pb-2 mb-4 snap-x custom-scrollbar">
                                    @foreach($gambar as $index => $img)
                                        <div @click="activeIndex = {{ $index }}"
                                             class="shrink-0 w-16 h-16 rounded-lg cursor-pointer overflow-hidden border-2 transition-all duration-200 snap-center"
                                             :class="activeIndex === {{ $index }} ? 'border-[#07E200] opacity-100' : 'border-transparent opacity-50 hover:opacity-100'">
                                            <img alt="" src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @error('gambar.*') <p class="text-[10px] text-red-500 mb-3 text-center">{{ $message }}</p> @enderror
                            @error('gambar') <p class="text-[10px] text-red-500 mb-3 text-center">{{ $message }}</p> @enderror

                            <div x-data="imageCompressor()" class="relative">
                                <input
                                    type="file"
                                    multiple
                                    accept="image/jpeg, image/png, image/webp, image/jpg"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 disabled:cursor-not-allowed"
                                    @change="handleFiles"
                                    x-bind:disabled="isUploading"
                                >
                                <button type="button" class="w-full text-xs font-semibold text-gray-500 border border-dashed border-gray-300 py-2.5 rounded-xl hover:border-[#07E200] hover:text-[#07E200] transition-colors flex items-center justify-center gap-1.5" :class="isUploading ? 'bg-gray-50 opacity-50' : ''">

                                    <svg x-show="!isUploading" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>

                                    <svg x-show="isUploading" class="w-4 h-4 animate-spin text-[#07E200]" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>

                                    <span x-text="isUploading ? `Mengompres & Mengunggah... (${uploadProgress}%)` : 'Tambah Foto Baru'"></span>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-2xl p-5 space-y-3">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Status & Inventori</p>
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
                                    <label class="text-xs font-semibold text-gray-500">Stok Awal <span class="text-red-400">*</span></label>
                                    <input type="number" wire:model="stok" min="0" placeholder="0" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('stok') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-500">Lokasi Penyimpanan <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="penyimpanan" placeholder="Contoh: Gudang A" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('penyimpanan') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-5">Informasi Produk</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Nama Barang <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="nama" placeholder="Masukan nama lengkap barang" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('nama_barang') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Kategori <span class="text-red-400">*</span></label>
                                    <select wire:model="idKategori" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriList as $kat)
                                            <option value="{{ $kat['id_kategori'] }}">{{ $kat['nama_kategori'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Kode Barang / SKU <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="kodeBarang" placeholder="Contoh: BRG-001" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('kode_barang') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Harga Jual <span class="text-red-400">*</span></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-sm text-gray-400 font-medium">Rp</span>
                                        <input type="number" wire:model="harga" min="0" placeholder="0" class="w-full pl-9 pr-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    </div>
                                    @error('harga') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2 mt-6 pt-6 border-t border-gray-100">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-xs font-bold text-gray-900">Spesifikasi Tambahan</p>
                                            <p class="text-[10px] text-gray-400">Atribut kustom (Bahan, Ukuran, Warna, dll)</p>
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
                                            <div class="flex flex-col sm:flex-row items-start gap-3">
                                                <div class="flex-1 w-full sm:w-auto">
                                                    <input type="text" wire:model="specList.{{ $index }}.label" placeholder="Nama Label" class="w-full px-3.5 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                                </div>
                                                <div class="flex-1 w-full sm:w-auto">
                                                    <input type="text" wire:model="specList.{{ $index }}.value" placeholder="Nilai Spesifikasi" class="w-full px-3.5 py-2 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                                </div>
                                                <button type="button" wire:click="removeSpec({{ $index }})" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach

                                        @if(count($specList) === 0)
                                            <div class="text-center py-8 border-2 border-dashed border-gray-100 rounded-2xl">
                                                <p class="text-xs text-gray-400 italic">Belum ada spesifikasi tambahan yang ditambahkan.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('scripts.image_compresor')
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</div>
