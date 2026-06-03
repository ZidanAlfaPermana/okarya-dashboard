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

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="9 18 15 12 9 6" />
                            </svg>
                            <a href="{{ route('kategori') }}" class="text-gray-600 font-medium">Kategori</a>
                        </div>
                    </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Daftar Kategori</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $kategori->total() }} kategori ditemukan di database
                        </p>
                    </div>
                    <a href="{{ route('kategori.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-white px-4 py-2.5 rounded-xl transition-opacity hover:opacity-90 bg-[#07E200]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" />
                        </svg> Tambah Kategori
                    </a>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama kategori" class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 transition-all" />
                    </div>
                </div>

                <div wire:loading.flex class="justify-center py-10">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#07E200]"></div>
                </div>

                <div wire:loading.remove>
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Nama Kategori</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Deskripsi</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                @forelse ($kategori as $var)
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-5 py-3.5">
                                            <span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full font-medium">
                                                {{ $var['nama_kategori'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full font-medium">
                                                {{ $var['deskripsi'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-right space-x-1">
                                            <div class="flex justify-center items-center">
                                                <a href="{{ url('kategori/edit/'.$var['id_kategori']) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-[#07E200] hover:bg-green-50 transition-colors inline-block">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <button
                                                    wire:click="konfirmasiBatal('{{ $var['id_kategori'] }}', '{{ $var['nama_kategori'] }}')"
                                                    class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6" /><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a1 1 0 011-1h2a1 1 0 011 1v2" /></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-5 py-10 text-center text-gray-400 text-sm">Data tidak tersedia.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $kategori->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
