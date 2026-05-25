@props(['grafik'])

<div
    x-data="{
        chart: null,
        periode: 'minggu',
        async setPeriode(p) {
            if (this.periode === p) return;
            this.periode = p;
            const data = await $wire.call('getGrafikData', p);
            this.buildChart(data.labels, data.data);
        },
        buildChart(labels, data) {
            if (this.chart) this.chart.destroy();

            const canvas = document.getElementById('salesChart');
            if (!canvas) return;

            const maxVal = Math.max(...data);
            this.chart = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: data.map(v => v === maxVal ? '#07E200' : 'rgba(7,226,0,0.65)'),
                        borderRadius: 6,
                        borderSkipped: false,
                        barPercentage: 0.6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                label: (ctx) => ' Rp ' + (ctx.parsed.y / 1000).toFixed(0) + 'rb'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { font: { size: 10 }, color: '#9ca3af' }
                        },
                        y: {
                            display: false,
                            grid: { display: false },
                        }
                    }
                }
            });
        }
    }"
    x-init="buildChart({{ Js::from($grafik['labels']) }}, {{ Js::from($grafik['data']) }})"
    wire:ignore
    class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 p-5"
>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-sm font-bold text-gray-900">Ringkasan Penjualan</h2>
            <p class="text-xs text-gray-400">7 hari terakhir</p>
        </div>
        <div class="flex gap-1.5">
            <button
                @click="setPeriode('minggu')"
                :class="periode === 'minggu' ? 'text-white' : 'text-gray-500 hover:bg-gray-50'"
                :style="periode === 'minggu' ? 'background:#07E200' : ''"
                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors"
            >Minggu</button>
            <button
                @click="setPeriode('bulan')"
                :class="periode === 'bulan' ? 'text-white' : 'text-gray-500 hover:bg-gray-50'"
                :style="periode === 'bulan' ? 'background:#07E200' : ''"
                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors"
            >Bulan</button>
        </div>
    </div>

    {{-- Chart --}}
    <div class="h-40 mb-3">
        <canvas id="salesChart"></canvas>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
        <div>
            <p class="text-xs text-gray-400">Total Minggu Ini</p>
            <p class="text-lg font-extrabold text-gray-900">
                Rp {{ number_format($grafik['summary']['total_minggu_ini'], 0, ',', '.') }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">Rata-rata / Hari</p>
            <p class="text-lg font-extrabold text-gray-900">
                Rp {{ number_format($grafik['summary']['rata_rata'], 0, ',', '.') }}
            </p>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">Hari Terbaik</p>
            <p class="text-lg font-extrabold" style="color:#07E200">
                {{ ucfirst($grafik['summary']['hari_terbaik']) }}
            </p>
        </div>
    </div>
</div>
