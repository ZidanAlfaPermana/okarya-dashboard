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
                    <h1 class="text-base sm:text-lg font-bold text-gray-900">Dashboard Pembayaran</h1>
                </div>
            </header>
            <main class="flex-1 p-4 sm:p-6 space-y-6">
                <x-message_notification></x-message_notification>
                @if(!empty($pembayaran))
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4">
                            <div class="px-2">
                                <div class="flex items-center gap-2">
                                    <h1 class="text-xl font-black text-gray-900">{{ $pembayaran->kode_transaksi }}</h1>
                                </div>
                                <p class="text-xs font-medium text-gray-400 mt-0.5">Waktu Transaksi: {{ $pembayaran->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            @if($pembayaran->status === 'pending' && $pembayaran->payment_type === "cash")
                                <button wire:click="batalkanTransaksi" class="px-4 py-2 text-xs font-bold text-red-600 border border-red-200 bg-red-50 rounded-xl hover:bg-red-100 transition-colors">
                                    Batalkan Transaksi
                                </button>
                                <button wire:click="konfirmasiPembayaran" class="px-4 py-2 text-xs font-bold text-white bg-[#07E200] rounded-xl hover:opacity-90 transition-opacity flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    Konfirmasi Lunas
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <h2 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Daftar Produk</h2>
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                        <tr class="text-xs text-gray-400 uppercase border-b border-gray-100 bg-gray-50/50">
                                            <th class="px-4 py-3 font-semibold">Produk</th>
                                            <th class="px-4 py-3 font-semibold text-center">Jumlah</th>
                                            <th class="px-4 py-3 font-semibold text-right">Harga Satuan</th>
                                            <th class="px-4 py-3 font-semibold text-right">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody class="text-sm text-gray-700 divide-y divide-gray-50">
                                        @foreach($pembayaran->item as $item)
                                            <tr>
                                                <td class="px-4 py-4">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-12 h-12 rounded-xl bg-gray-50 border border-gray-100 overflow-hidden flex-shrink-0">
                                                            <img src="{{ $item->barang->gambar->first()->gambar ?? asset('images/placeholder.png') }}" class="w-full h-full object-cover">
                                                        </div>
                                                        <div>
                                                            <p class="font-bold text-gray-800">{{ $item->barang->nama_barang }}</p>
                                                            <p class="text-xs text-gray-400">{{ $item->barang->kode_barang }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-center font-semibold text-gray-600">{{ $item->qty }}</td>
                                                <td class="px-4 py-4 text-right font-medium text-gray-600">Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                                                <td class="px-4 py-4 text-right font-bold text-gray-800">Rp {{ number_format($item->barang->harga * $item->qty, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm space-y-4">
                                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Status & Pembayaran</h2>

                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <span class="text-xs font-semibold text-gray-500">Status Transaksi</span>
                                    @if(strtolower($pembayaran->status) === 'success' || strtolower($pembayaran->status) === 'settlement')
                                        <span class="px-3 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full">Selesai</span>
                                    @elseif(strtolower($pembayaran->status) === 'pending')
                                        <span class="px-3 py-1 text-xs font-bold text-orange-700 bg-orange-100 rounded-full">Diproses</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">Gagal / Batal</span>
                                    @endif
                                </div>

                                <div class="space-y-2.5 pt-2 border-t border-gray-100 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Metode Pembayaran</span>
                                        <span class="font-bold text-gray-800 uppercase">{{ $pembayaran->payment_type ?? 'Tunai' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm space-y-4">
                                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Informasi Pelanggan</h2>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center w-10 h-10 text-xs font-bold text-white bg-[#07E200] rounded-full">
                                        {{ strtoupper(substr($pembayaran->user->name ?? 'G', 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $pembayaran->user->name ?? 'Guest/Pelanggan Tunai' }}</p>
                                        <p class="text-xs text-gray-400">{{ $pembayaran->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm space-y-3">
                                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Ringkasan Total</h2>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Subtotal</span>
                                        <span class="font-medium text-gray-700">Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between pt-3 border-t border-gray-100">
                                        <span class="text-base font-bold text-gray-900">Total Bayar</span>
                                        <span class="text-base font-black text-[#07E200]">Rp {{ number_format($pembayaran->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @empty($pembayaran)
                    <div class="flex flex-col col-span-full pt-10 justify-center items-center text-center gap-2 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        <h3 class="col-span-full text-gray-500 text-2xl">Transaksi Kosong</h3>
                        <p class="col-span-full text-gray-400">Tidak ada transaksi yang ditemukan.</p>
                    </div>
                @endempty
            </main>
        </div>
    </div>
</div>
