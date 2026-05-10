<div class="min-h-screen bg-white p-4 sm:p-8 antialiased text-black">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 print:hidden">
        <div class="flex items-center gap-6">
            <a href="{{ route('produk') }}" class="flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>

            <div class="flex items-center gap-3 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                <label class="text-xs font-bold text-gray-400 uppercase">No. Awal:</label>
                <input type="number" wire:model.live="startNumber" class="w-20 px-2 py-1 text-sm font-bold border border-gray-200 rounded-lg outline-none focus:border-[#07E200] transition-all" min="1">
            </div>
        </div>

        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-[#07E200] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-[#07E200]/20 hover:opacity-90 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
            Cetak Form
        </button>
    </div>

    <div class="max-w-[1100px] mx-auto border-black print:border-none">
        <div class="text-center border-b-2 border-black pb-4 mb-6">
            <h1 class="text-2xl font-black uppercase tracking-tighter">Form Pengisian Data Barang</h1>
            <p class="text-sm font-medium text-gray-600">Toko Vohisma - Inventaris Siswa SMKN 5 Malang</p>
            <p class="print:hidden text-[10px] text-gray-400 mt-1 italic font-mono uppercase tracking-widest">Halaman Nomor: {{ $startNumber }} - {{ $startNumber + 19 }}</p>
        </div>

        <table class="w-full border-collapse border border-black text-[11px]">
            <thead>
            <tr class="bg-gray-100 text-center">
                <th class="border border-black px-2 py-3 w-10 uppercase font-bold">No</th>
                <th class="border border-black px-3 py-3 w-48 uppercase font-bold">Nama Barang</th>
                <th class="border border-black px-2 py-3 w-28 uppercase font-bold">Kode / SKU</th>
                <th class="border border-black px-2 py-3 w-24 uppercase font-bold">Kategori</th>
                <th class="border border-black px-2 py-3 w-28 uppercase font-bold">Harga (Rp)</th>
                <th class="border border-black px-2 py-3 w-14 uppercase font-bold">Stok</th>
                <th class="border border-black px-2 py-3 w-32 uppercase font-bold">Lokasi</th>
                <th class="border border-black px-2 py-3 w-40 uppercase font-bold">Spesifikasi</th>
                <th class="border border-black px-2 py-3 w-20 uppercase font-bold">Status</th>
            </tr>
            </thead>
            <tbody>
            @for ($i = 0; $i < 20; $i++)
                <tr class="h-10">
                    <td class="border border-black text-center font-bold bg-gray-50/50">
                        {{ (int)$startNumber + $i }}
                    </td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black"></td>
                    <td class="border border-black text-[9px] text-gray-700 px-1 text-center">Aktif / Draft</td>
                </tr>
            @endfor
            </tbody>
        </table>

        <div class="mt-10 flex justify-end">
            <div class="text-center w-64">
                <p class="text-xs mb-16 italic">Malang, ........................... 20...</p>
                <p class="text-xs font-bold uppercase underline">....................................................</p>
                <p class="text-[10px] text-gray-500 mt-1">Petugas Inventaris</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            @page { margin: 1cm; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</div>
