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

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <a href="{{ route('welcome') }}" class="hover:text-gray-600 transition-colors">Dashboard</a>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                        <a href="{{ route('pesanan') }}" class="text-gray-600 font-medium">Data pesanan</a>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div>
                        <h1 class="text-xl font-extrabold text-gray-900">Riwayat Pembayaran</h1>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $pembayaran->total() }} transaksi tercatat di sistem
                        </p>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-4 mb-5 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Kode Transaksi | 5 angka pada kode tengah Ex:TRX-xxxxx63367-xxxxx" class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl bg-gray-50 outline-none focus:border-[#07E200] focus:ring-2 focus:ring-[#07E200]/20 transition-all" />
                    </div>
                    <select wire:model.live="status" class="text-sm border border-gray-200 rounded-xl bg-gray-50 px-3 py-2.5 outline-none focus:border-[#07E200] sm:w-48">
                        <option value="pending">Pending</option>
                        <option value="success">Settlement / Sukses</option>
                        <option value="expire">Expired</option>
                        <option value="cancel">Batal</option>
                        <option value=""> Semua Status </option>
                    </select>
                    {{--<button type="button" class="text-sm text-white border border-gray-200 rounded-xl bg-red-500 flex justify-center items-center py-2.5 outline-none sm:w-12">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                        </svg>
                    </button>--}}
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
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">No. Transaksi</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Pelanggan</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Tanggal</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Metode</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Total Pembayaran</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide">Status</th>
                                    <th class="px-5 py-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wide text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                @forelse ($pembayaran as $var)
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-5 py-3.5">
                                            <span class="text-sm font-bold text-gray-900">
                                                #{{ $var['kode_transaksi'] }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="text-xs text-gray-700 font-bold">
                                                {{ $var['user']['name'] ?? 'User ID: ' . $var['user_id'] }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="text-xs text-gray-500 font-medium">
                                                {{ isset($var['created_at']) ? date('d M Y, H:i', strtotime($var['created_at'])) : '-' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-500 px-2 py-1 rounded-md">
                                                {{ $var['payment_type'] ? str_replace('_', ' ', $var['payment_type']) : 'BELUM DIPILIH' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="text-sm font-extrabold text-[#07E200]">
                                                Rp {{ number_format($var['total'] ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span @class([
                                                'text-[10px] uppercase tracking-wide font-bold px-2.5 py-1 rounded-full',
                                                'bg-orange-100 text-orange-600' => in_array(strtolower($var['status']), ['pending']),
                                                'bg-[#F0FDF0] text-[#07E200]' => in_array(strtolower($var['status']), ['success', 'settlement', 'berhasil']),
                                                'bg-red-100 text-red-600' => in_array(strtolower($var['status']), ['cancel', 'expire', 'deny', 'failed', 'gagal']),
                                                'bg-gray-100 text-gray-500' => !in_array(strtolower($var['status']), ['pending', 'success', 'settlement', 'berhasil', 'cancel', 'expire', 'deny', 'failed', 'gagal'])
                                            ])>
                                                {{ $var['status'] ?? 'Unknown' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-right space-x-1">
                                            <div class="flex justify-center items-center">
                                                <a href="{{ url('pesanan/detail/'.$var['kode_transaksi']) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-blue-500 hover:bg-blue-50 transition-colors inline-block" title="Lihat Detail">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-5 py-10 text-center text-gray-400 text-sm">Belum ada data pembayaran.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $pembayaran->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
