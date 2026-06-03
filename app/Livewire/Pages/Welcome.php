<?php

namespace App\Livewire\Pages;

use App\Models\Barang;
use App\Models\ItemTransaction;
use App\Models\Kategori;
use App\Models\Pembayaran;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Welcome extends Component
{
    public string $periode = 'minggu';
    public array $grafik = [];

    public function mount(): void
    {
        $data = $this->getStatistics(); // method yang sudah ada
        $this->grafik = $data['grafik'];
    }

    public function getStatistics(): array
    {
        try {
            $now = Carbon::now();
            $startOfWeek = $now->copy()->startOfWeek();
            $endOfWeek = $now->copy()->endOfWeek();

            $totalPendapatan = Pembayaran::where('status', 'settlement')->sum('total');
            $totalPesanan = Pembayaran::count();
            $totalKategori = Kategori::count();
            $totalProduk = Barang::count();

            $grafikData = [];
            $labels = [];
            $totalMingguIni = 0;
            $hariTerbaik = '';
            $maxPenjualan = 0;

            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dayName = $date->locale('id')->isoFormat('dddd');
                $dayLabel = $date->locale('id')->isoFormat('ddd');

                $penjualanHariIni = Pembayaran::where('status', 'settlement')
                    ->whereDate('created_at', $date->toDateString())
                    ->sum('total');

                $grafikData[] = (int) $penjualanHariIni;
                $labels[] = $dayLabel;
                $totalMingguIni += $penjualanHariIni;

                if ($penjualanHariIni > $maxPenjualan) {
                    $maxPenjualan = $penjualanHariIni;
                    $hariTerbaik = $dayName;
                }
            }
            $rataRataHari = $totalMingguIni / 7;

            $produkTerlaris = ItemTransaction::select('id_barang', DB::raw('SUM(qty) as total_terjual'))
                ->with(['barang' => function ($q) {
                    $q->select('id_barang', 'nama_barang');
                }])
                ->groupBy('id_barang')
                ->orderByDesc('total_terjual')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama_barang' => $item->barang->nama_barang ?? 'Produk Terhapus',
                        'persentase' => $this->getPresentationalSold($item->barang()->value('stok'), (int) $item->total_terjual),
                        'total' => (int) $item->total_terjual,
                        'stok' => $item->barang()->value('stok'),
                    ];
                })->toArray();
            $pesananTerbaru = Pembayaran::with(['user', 'item.barang'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($trx) {
                    $namaProduk = $trx->item->first()->barang->nama_barang ?? 'Item';
                    $sisaItem = $trx->item->count() > 1 ? ' + '.($trx->item->count() - 1).' item lain' : '';

                    return [
                        'kode_transaksi' => $trx->kode_transaksi,
                        'pelanggan' => $trx->user->name ?? 'Guest',
                        'produk' => $namaProduk.$sisaItem,
                        'total' => (int) $trx->total,
                        'status' => $trx->status,
                    ];
                })->toArray();
            $stokMenipis = Barang::where('stok', '<=', 10)
                ->orderBy('stok', 'asc')
                ->limit(5)
                ->get(['id_barang', 'nama_barang', 'stok', 'kode_barang'])->toArray();
            $data = [
                'kpi' => [
                    'pendapatan' => ['total' => (int) $totalPendapatan],
                    'pesanan' => ['total' => $totalPesanan],
                    'kategori' => ['total' => $totalKategori],
                    'produk' => ['total' => $totalProduk],
                ],
                'grafik' => [
                    'labels' => $labels,
                    'data' => $grafikData,
                    'summary' => [
                        'total_minggu_ini' => $totalMingguIni,
                        'rata_rata' => round($rataRataHari),
                        'hari_terbaik' => $hariTerbaik ?: '-',
                    ],
                ],
                'produk_terlaris' => $produkTerlaris,
                'pesanan_terbaru' => $pesananTerbaru,
                'stok_menipis' => $stokMenipis,
            ];

            return $data;
        } catch (\Exception) {
            return [];
        }
    }

    private function getPresentationalSold($stok, $total_sold): int
    {
        if ($stok == 0 && $total_sold > 0) {
            return 100;
        } else {
            $data = $stok > 0 && $total_sold > 0 ? ($total_sold / $stok) * 100 : 0;

            return max(0, min(100, $data));
        }
    }

    public function setPeriode(string $periode): void
    {
        $this->periode = $periode;

        if ($periode === 'bulan') {
            $this->grafik = $this->getGrafikBulan();
        } else {
            $data = $this->getStatistics();
            $this->grafik = $data['grafik'];
        }
    }

    private function getGrafikBulan(): array
    {
        $labels = [];
        $grafikData = [];
        $totalBulan = 0;
        $hariTerbaik = '';
        $maxPenjualan = 0;

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayLabel = $date->format('d/m');
            $dayName = $date->locale('id')->isoFormat('dddd');

            $penjualan = Pembayaran::where('status', 'success')
                ->whereDate('created_at', $date->toDateString())
                ->sum('total');

            $grafikData[] = (int) $penjualan;
            $labels[] = $dayLabel;
            $totalBulan += $penjualan;

            if ($penjualan > $maxPenjualan) {
                $maxPenjualan = $penjualan;
                $hariTerbaik = $dayName;
            }
        }

        return [
            'labels' => $labels,
            'data' => $grafikData,
            'summary' => [
                'total_minggu_ini' => $totalBulan,
                'rata_rata' => round($totalBulan / 30),
                'hari_terbaik' => $hariTerbaik ?: '-',
            ],
        ];
    }

    public function getGrafikData(string $periode): array
    {
        if ($periode === 'bulan') {
            return $this->getGrafikBulan();
        }

        $data = $this->getStatistics();
        return $data['grafik'];
    }

    public function render()
    {
        return view('welcome', ['data' => $this->getStatistics(), 'chart' => $this->getGrafikBulan()]);
    }
}
