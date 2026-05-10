<?php

namespace App\Livewire\Pages\Data;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduk extends Component
{
    use WithFileUploads;

    public $kodeBarang;

    public string $nama = '';

    public $gambarUploads = [];

    public int $idKategori;

    public string $namaKategori = '';

    public string $penyimpanan = '';

    public $gambar = [];

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
            $this->kategoriList = $response->json('data.data', []);
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

    public function removeGambar(int $index): void
    {
        if (isset($this->gambar[$index])) {
            unset($this->gambar[$index]);
            $this->gambar = array_values($this->gambar);
        }
    }

    public function save(): void
    {
        $this->validate([
            'gambar' => 'required|array|min:1',
            'gambar.*' => 'image|max:2048',
        ], [
            'gambar.required' => 'Minimal upload 1 gambar produk.',
        ]);

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

            $idBarang = $response->json('data.id_barang');

            if (! empty($this->gambar) && $idBarang) {
                $imageRequest = Http::withToken(session('api_token'));

                foreach ($this->gambar as $file) {
                    $imageRequest->attach(
                        'gambar[]',
                        file_get_contents($file->getRealPath()),
                        $file->getClientOriginalName()
                    );
                }

                $imageRequest->post(config('api.base_url').'/gambar', [
                    'id_barang' => $idBarang,
                ]);
            }
            session()->flash('success', 'Produk dan Gambar berhasil ditambahkan.');
            $this->redirect(config('app.url')."/produk/detail/{$this->kodeBarang}");
        } else {
            session()->flash('error', 'Gagal memperbarui produk. Pastikan semua data benar.');
        }
    }

    public function updatedGambarUploads(): void
    {
        foreach ($this->gambarUploads as $file) {
            $this->gambar[] = $file;
        }
        $this->gambarUploads = [];
    }

    public function render()
    {
        return view('livewire.pages.data.add_produk');
    }
}
