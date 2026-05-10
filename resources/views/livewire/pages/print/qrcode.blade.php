<div x-data="{ qrSize: 3.5 }" class="min-h-screen bg-gray-50 pb-20 antialiased">
    <div class="sticky top-0 z-20 bg-white border-b border-gray-200 p-4 shadow-sm print:hidden">
        <div class="max-w-6xl mx-auto flex flex-col xl:flex-row xl:items-center justify-between gap-4">

            <div class="shrink-0">
                <a href="{{ route('produk') }}" class="flex items-center gap-2 text-xs font-semibold text-gray-400 hover:text-gray-600 mb-1 transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </a>
                <h1 class="text-lg font-bold text-gray-900">Cetak QR Code Produk</h1>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <div class="flex flex-wrap sm:flex-nowrap items-center gap-4 bg-gray-50 px-4 py-2 rounded-2xl border border-gray-100">

                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase mb-1">Kode Barang</span>
                        <input type="text"
                               wire:model.live.debounce.500ms="kode_barang"
                               placeholder="Semua (Atau isi kode)"
                               class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg px-3 py-1.5 w-40 focus:outline-none focus:border-[#07E200] focus:ring-1 focus:ring-[#07E200] transition-colors">
                    </div>

                    <div class="hidden sm:block w-px h-8 bg-gray-200"></div>

                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase mb-1">Jumlah Cetak</span>
                        <div class="flex items-center gap-2">
                            <select wire:model.live="limitMode" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg px-3 py-1.5 focus:outline-none focus:border-[#07E200] focus:ring-1 focus:ring-[#07E200] transition-colors">
                                <option value="auto">Sesuai Stok</option>
                                <option value="custom">Custom</option>
                            </select>

                            @if($limitMode === 'custom')
                                <input type="number"
                                       wire:model.live.debounce.500ms="customLimit"
                                       min="1"
                                       class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg px-2 py-1.5 w-16 text-center focus:outline-none focus:border-[#07E200] focus:ring-1 focus:ring-[#07E200] transition-colors">
                            @endif
                        </div>
                    </div>

                </div>

                <div class="flex items-center gap-6 bg-gray-50 px-4 py-2 rounded-2xl border border-gray-100 shrink-0">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase">Ukuran QR (cm)</span>
                        <div class="flex items-center gap-3">
                            <input type="range" min="2" max="5" step="0.1" x-model="qrSize" class="w-24 sm:w-32 accent-[#07E200]">
                            <span class="text-sm font-black text-gray-700 w-8" x-text="qrSize"></span>
                        </div>
                    </div>

                    <button onclick="window.print()" class="bg-[#07E200] text-white px-5 py-2 rounded-xl font-bold text-sm shadow-lg shadow-[#07E200]/20 hover:opacity-90 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        Cetak
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto p-8 print:p-0 relative">

        <div wire:loading class="absolute inset-0 bg-white/50 z-10 backdrop-blur-sm print:hidden">
            <div class="flex items-center justify-center pt-20">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#07E200]"></div>
            </div>
        </div>

        @if(empty($qrcode))
            <div class="text-center py-20 text-gray-400 font-medium">
                Tidak ada QR Code untuk ditampilkan.
            </div>
        @else
            <div class="flex flex-wrap justify-center gap-6 print:gap-4 print:justify-start">
                @foreach($qrcode as $item)
                    <div class="flex flex-col items-center bg-white p-2 rounded-lg border border-gray-100 shadow-sm print:shadow-none print:border-gray-200 break-inside-avoid">
                        <div :style="`width: ${qrSize}cm; height: ${qrSize}cm`" class="bg-white flex items-center justify-center overflow-hidden border border-gray-50">
                            <img src="{{ $item['qr_code_full_url'] }}"
                                 alt="QR {{ $item['kode_barang'] }}"
                                 class="w-full h-full object-contain">
                        </div>

                        <div class="mt-1 text-center">
                            <p class="font-mono font-bold text-gray-900 uppercase tracking-tighter"
                               :style="`font-size: ${qrSize * 2.5}px`"
                               x-text="'{{ $item['kode_barang'] }}'">
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 1cm;
            }
            body {
                background-color: white;
            }
            .break-inside-avoid {
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }

        input[type=range] {
            -webkit-appearance: none;
            background: transparent;
        }
        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 10px;
        }
        input[type=range]::-webkit-slider-thumb {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            background: #07E200;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -6px;
            box-shadow: 0 0 10px rgba(7, 226, 0, 0.3);
        }
    </style>
</div>
