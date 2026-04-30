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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard Kategori</h1>
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
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-1.5">
                            <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <a href="{{ route('kategori') }}" class="hover:text-gray-600 transition-colors">Kategori</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <span class="hover:text-gray-600 transition-colors">Edit Kategori</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <span class="text-gray-600 font-medium">{{ $namaKategori }}</span>
                        </div>
                        <h1 class="text-xl font-extrabold text-gray-900">Edit Kategori Baru</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('kategori') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                            <svg wire:loading.remove wire:target="save" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span wire:loading wire:target="save" class="w-3 h-3 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            Simpan Kategori
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-5 space-y-3">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Status Kategori</p>

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
                                        <p class="text-[11px] text-gray-400">Kategori langsung tampil</p>
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
                                        <p class="text-[11px] text-gray-400">Kategori disembunyikan</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-5">Informasi Ketegori</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Nama Kategori <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="namaKategori" value="{{ $namaKategori }}" placeholder="Masukan nama kategori" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('namaKategori') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Deskripsi Kategori <span class="text-red-400">*</span></label>
                                    <textarea wire:model="deskripsiKategori" class="w-full  px-3.5 py-2.5 resize-none text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all">{{ $deskripsiKategori }}</textarea>
                                    @error('deskripsiKategori') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
