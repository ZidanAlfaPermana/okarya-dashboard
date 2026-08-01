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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard Account</h1>
                </div>
            </header>
            <main class="flex-1 p-4 sm:p-6 space-y-6">
               <x-message_notification></x-message_notification>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                            <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <a href="{{ route('produk') }}" class="hover:text-gray-600 transition-colors">Management Account</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <p class="text-gray-600 font-medium">Tambah Akun</p>
                        </div>
                        <h1 class="text-xl font-extrabold text-gray-900">Tambah Akun Baru</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('account') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button wire:click="save" wire:loading.attr="disabled" class="inline-flex items-center gap-1.5 text-xs font-bold text-white px-3.5 py-2 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                            <svg wire:loading.remove wire:target="save" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            <span wire:loading wire:target="save" class="w-3 h-3 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                            Simpan Akun
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm" x-data="{ activeIndex: 0 }">
                            <div class="flex flex-col items-center w-full mb-5">
                                <div class="w-20 h-20 rounded-full flex items-center justify-center text-white text-[35px] font-bold bg-[#07E200] mb-3">
                                    <span x-text="$wire.name[0] || '?'"></span>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800" x-text="$wire.name || 'Nama Pengguna'"></h2>
                                <p class="text-sm text-gray-500" x-text="$wire.email || 'example12@gmail.com'"></p>
                            </div>
                            <hr class="border-gray-100 mb-4">
                            <div class="flex flex-col space-y-3">
                                <h2 class="text-md font-bold text-gray-800">Detail</h2>
                                <div class="grid grid-cols-1 w-full space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">No. Telp</span>
                                        <span class="text-sm font-semibold text-gray-800" x-text="$wire.telp || '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-500">User Role</span>
                                        <span class="text-sm font-semibold text-gray-800">{{ ucfirst($level) ?? 'user' }}</span>
                                    </div>
                                </div>
                                <hr class="border-gray-100 mb-4">
                                <h2 class="text-md font-bold text-gray-800">Hak Akses</h2>
                                <div class="flex flex-col space-y-4 w-full h-[270px] overflow-y-auto pr-2 custom-scrollbar">
                                    <div class="flex flex-col pb-3 border-b border-gray-100 last:border-0">
                                        <div class="flex justify-between items-center w-full mb-2">
                                            <span class="text-sm font-semibold text-gray-800">Manajemen Produk</span>

                                            @if(($can_create ?? false) && ($can_read ?? false) && ($can_update ?? false) && ($can_delete ?? false))
                                                <span class="px-2 py-0.5 bg-green-50 text-green-600 border border-green-200 rounded text-[10px] font-bold uppercase tracking-wider">Akses Penuh</span>
                                            @elseif(($can_create ?? false) || ($can_read ?? false) || ($can_update ?? false) || ($can_delete ?? false))
                                                <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded text-[10px] font-bold uppercase tracking-wider">Sebagian</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-red-50 text-red-600 border border-red-200 rounded text-[10px] font-bold uppercase tracking-wider">Tanpa Akses</span>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium {{ ($can_create ?? false) ? 'text-gray-700' : 'text-gray-300 line-through' }}">Create</span>
                                                <div class="w-1.5 h-1.5 rounded-full {{ ($can_create ?? false) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium {{ ($can_read ?? false) ? 'text-gray-700' : 'text-gray-300 line-through' }}">Read</span>
                                                <div class="w-1.5 h-1.5 rounded-full {{ ($can_read ?? false) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium {{ ($can_update ?? false) ? 'text-gray-700' : 'text-gray-300 line-through' }}">Update</span>
                                                <div class="w-1.5 h-1.5 rounded-full {{ ($can_update ?? false) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium {{ ($can_delete ?? false) ? 'text-gray-700' : 'text-gray-300 line-through' }}">Delete</span>
                                                <div class="w-1.5 h-1.5 rounded-full {{ ($can_delete ?? false) ? 'bg-green-500' : 'bg-gray-200' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col pb-3 border-b border-gray-100 last:border-0">
                                        <div class="flex justify-between items-center w-full mb-2">
                                            <span class="text-sm font-semibold text-gray-800">Manajemen Kategori</span>
                                            <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded text-[10px] font-bold uppercase tracking-wider">Sebagian</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Create</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Read</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Update</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Delete</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col pb-3 border-b border-gray-100 last:border-0">
                                        <div class="flex justify-between items-center w-full mb-2">
                                            <span class="text-sm font-semibold text-gray-800">Manajemen Pesanan</span>
                                            <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded text-[10px] font-bold uppercase tracking-wider">Sebagian</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Create</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Read</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Update</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Delete</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col pb-3 border-b border-gray-100 last:border-0">
                                        <div class="flex justify-between items-center w-full mb-2">
                                            <span class="text-sm font-semibold text-gray-800">Manajemen Akun</span>
                                            <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 border border-yellow-200 rounded text-[10px] font-bold uppercase tracking-wider">Sebagian</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Create</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Read</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-700">Update</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <span class="text-xs font-medium text-gray-300 line-through">Delete</span>
                                                <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6">
                            <p class="text-sm font-bold text-gray-900 mb-5">Informasi Akun</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Nama Lengkap <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="name" placeholder="Masukan nama lengkap pengguna" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('nama') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Email <span class="text-red-400">*</span></label>
                                    <input type="email" wire:model="email" placeholder="contoh@email.com" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('email') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">No. Telepon / WhatsApp</label>
                                    <input type="text" wire:model="telp" placeholder="081234567890" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('telp') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">Password <span class="text-red-400">*</span></label>
                                    <input type="text" wire:model="password" placeholder="Masukan password yang kuat" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all" />
                                    @error('password') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2 space-y-1.5">
                                    <label class="text-xs font-semibold text-gray-600">User Role <span class="text-red-400">*</span></label>
                                    <select wire:model="role" class="w-full px-3.5 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 text-gray-800 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 focus:bg-white transition-all">
                                        <option value="">Pilih Jabatan</option>
                                        <option value="admin">Administrator</option>
                                        <option value="staff">Staff Operasional</option>
                                        <option value="viewer">Viewer / Guest</option>
                                    </select>
                                    @error('role') <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2 mt-6 pt-6 border-t border-gray-100">
                                    <div class="mb-4">
                                        <p class="text-sm font-bold text-gray-900">Pengaturan Privilege (Hak Akses)</p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">Tentukan modul dan tindakan yang dapat diakses oleh akun ini. Mengaktifkan akses utama akan otomatis memberikan semua sub-akses.</p>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="border border-gray-100 rounded-xl overflow-hidden" x-data="{ mainAkses: false, canCreate: false, canRead: false, canUpdate: false, canDelete: false }">
                                            <div class="flex items-center justify-between p-3.5 bg-gray-50 border-b border-gray-100">
                                                <span class="text-sm font-semibold text-gray-800">Manajemen Produk</span>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" wire:model="privilege.produk.main" x-model="mainAkses" class="sr-only peer">
                                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#07E200]"></div>
                                                    <span class="ml-2 text-xs font-bold" :class="mainAkses ? 'text-[#07E200]' : 'text-gray-500'" x-text="mainAkses ? 'Akses Penuh' : 'Atur Manual'"></span>
                                                </label>
                                            </div>
                                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-3 bg-white">
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.produk.create" x-model="canCreate" :checked="mainAkses || canCreate" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Create</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.produk.read" x-model="canRead" :checked="mainAkses || canRead" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Read</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.produk.update" x-model="canUpdate" :checked="mainAkses || canUpdate" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Update</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.produk.delete" x-model="canDelete" :checked="mainAkses || canDelete" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Delete</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="border border-gray-100 rounded-xl overflow-hidden" x-data="{ mainAkses: false, canCreate: false, canRead: false, canUpdate: false, canDelete: false }">
                                            <div class="flex items-center justify-between p-3.5 bg-gray-50 border-b border-gray-100">
                                                <span class="text-sm font-semibold text-gray-800">Manajemen Kategori</span>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" wire:model="privilege.kategori.main" x-model="mainAkses" class="sr-only peer">
                                                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#07E200]"></div>
                                                    <span class="ml-2 text-xs font-bold" :class="mainAkses ? 'text-[#07E200]' : 'text-gray-500'" x-text="mainAkses ? 'Akses Penuh' : 'Atur Manual'"></span>
                                                </label>
                                            </div>
                                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-3 bg-white">
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.kategori.create" x-model="canCreate" :checked="mainAkses || canCreate" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Create</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.kategori.read" x-model="canRead" :checked="mainAkses || canRead" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Read</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.kategori.update" x-model="canUpdate" :checked="mainAkses || canUpdate" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Update</span>
                                                </label>
                                                <label class="flex items-center space-x-2" :class="mainAkses ? 'opacity-50 cursor-not-allowed grayscale' : 'cursor-pointer'">
                                                    <input type="checkbox" wire:model="privilege.kategori.delete" x-model="canDelete" :checked="mainAkses || canDelete" :disabled="mainAkses" class="w-4 h-4 accent-[#07E200] rounded border-gray-300 disabled:bg-gray-200">
                                                    <span class="text-xs font-medium" :class="mainAkses ? 'text-gray-500' : 'text-gray-700'">Delete</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <style>
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</div>
