<?php

namespace App\Livewire\Pages\Data;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddProduk extends Component
{
    public $kodeBarang;

    public string $nama = '';

    public int $idKategori;

    public string $namaKategori = '';

    public string $penyimpanan = '';

    public string $gambarUrl = '';

    public int $harga = 0;

    public int $stok = 0;

    public string $status;

    public array $specList = [];

    public array $kategoriList = [];

    public array $statistik = [];

    public array $specification = [];

    public function mount(): void
    {
        $this->fetchKategori();
    }

    private function fetchKategori(): void
    {
        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/kategori');

        if ($response->successful()) {
            $this->kategoriList = $response->json('data', []);
        }
    }

    public function addSpec(): void
    {
        $this->specList[] = ['label' => '', 'value' => ''];
    }

    public function removeSpec(int $index): void
    {
        unset($this->specList[$index]);
        $this->specList = array_values($this->specList);
    }

    public function save(): void
    {
        $formattedSpecs = [];
        foreach ($this->specList as $spec) {
            if (! empty($spec['label'])) {
                $formattedSpecs[$spec['label']] = $spec['value'];
            }
        }

        $response = Http::withToken(session('api_token'))
            ->post(config('api.base_url').'/barang', [
                'nama_barang' => $this->nama,
                'kode_barang' => $this->kodeBarang,
                'id_kategori' => $this->idKategori,
                'harga' => $this->harga,
                'stok' => $this->stok,
                'penyimpanan' => $this->penyimpanan,
                'specification' => $formattedSpecs,
                'status' => $this->status,
            ]);

        if ($response->successful()) {
            $this->redirect(config('app.url')."/produk/detail/{$this->kodeBarang}");

            session()->flash('success', 'Produk berhasil diperbarui.');
        } else {
            session()->flash('error', 'Gagal memperbarui produk. Pastikan semua data benar.');
        }
    }

    public function render()
    {
        return view('livewire.pages.data.add_produk');
    }
}
