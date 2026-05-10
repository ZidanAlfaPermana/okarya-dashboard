<?php

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Detail extends Component
{
    use WithFileUploads, WithPagination;

    public array $gambarUrl = [];

    public array $existingGambar = [];

    public $gambarUploads = [];

    public array $hapusGambarIds = [];

    public $gambar = [];

    public string $kodeBarang;

    public int $idBarang;

    public bool $isEditing = false;

    public string $nama = '';

    public int $idKategori;

    public string $namaKategori = '';

    public string $penyimpanan = '';

    public string $gambarQrCode = '';

    public int $harga = 0;

    public int $stok = 0;

    public $status;

    public $imageMode = 'produk';

    public array $specList = [];

    public array $kategoriList = [];

    public array $statistik = [];

    public array $specification = [];

    public function mount(string $id): void
    {
        $this->kodeBarang = $id;
        $this->fetchKategori();
        $this->loadProduk();
    }

    public function changeImageMode(string $mode): void
    {
        $this->imageMode = $mode;
        session(['image_view_mode' => $mode]);
    }

    private function fetchKategori(): void
    {
        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/kategori');

        if ($response->successful()) {
            $this->kategoriList = $response->json('data.data', []);
        }
    }

    private function buildPaginator(array $apiResponse): LengthAwarePaginator
    {
        $perPage = 5;

        $items = Collection::make($apiResponse['data'] ?? []);

        return new LengthAwarePaginator(
            items: $items,
            total: $apiResponse['total'] ?? $items->count(),
            perPage: $apiResponse['per_page'] ?? $perPage,
            currentPage: $apiResponse['current_page'] ?? $this->getPage(),
            options: [
                'path' => url()->current(),
            ]
        );
    }

    private function fetchRating()
    {
        $params = [
            'page' => $this->getPage(),
            'id_barang' => $this->idBarang,
        ];

        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/rating', $params);

        if ($response->failed()) {
            return [];
        }

        return $response->json()['data'] ?? [];
    }

    public function removeGambarBaru(int $index): void
    {
        if (isset($this->gambar[$index])) {
            unset($this->gambar[$index]);
            $this->gambar = array_values($this->gambar);
        }
    }

    public function removeExistingGambar(int $index, int $idGambar): void
    {
        $this->hapusGambarIds[] = $idGambar;
        unset($this->existingGambar[$index]);
        $this->existingGambar = array_values($this->existingGambar);
    }

    private function loadProduk(): void
    {
        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/barang?kode_barang='.$this->kodeBarang);
        if ($response->failed()) {
            session()->flash('error', 'Produk tidak ditemukan.');
            $this->redirect(route('produk'), navigate: true);

            return;
        }

        $data = $response->json('data.data.0', []);
        if (empty($data)) {
            return;
        }

        $this->nama = $data['nama_barang'] ?? '';
        $this->idBarang = $data['id_barang'] ?? 0;
        $this->harga = (int) ($data['harga'] ?? 0);
        $this->stok = (int) ($data['stok'] ?? 0);
        $this->penyimpanan = $data['penyimpanan'] ?? '';

        $this->existingGambar = $data['gambar'] ?? [];

        $this->idKategori = $data['id_kategori'] ?? 0;
        $this->namaKategori = $data['kategori']['nama_kategori'] ?? 'Tanpa Kategori';
        $this->status = $data['status'] ?? '';

        $this->gambarUrl = collect($data['gambar'])->pluck('gambar')->toArray() ?? [];
        $this->gambarQrCode = $data['qr_code_full_url'] ?? '';

        $this->specification = $data['specification'] ?? [];
        $this->specList = [];
        $specs = $data['specification'] ?? [];
        foreach ($specs as $key => $value) {
            $this->specList[] = ['label' => $key, 'value' => $value];
        }

        $this->statistik = [
            'rating_avg' => $data['rating_avg'] ?? 0,
            'rating_count' => $data['rating_count'] ?? 0,
        ];
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

    public function setMode(string $mode): void
    {
        if ($mode === 'edit') {
            $this->isEditing = true;
        } else {
            $this->isEditing = false;
            $this->resetValidation();
            $this->gambar = [];
            $this->hapusGambarIds = [];
            $this->loadProduk();
        }
    }

    public function save(): void
    {
        $this->validate([
            'gambar.*' => 'image|max:2048',
        ]);

        $formattedSpecs = [];
        foreach ($this->specList as $spec) {
            if (! empty($spec['label'])) {
                $formattedSpecs[$spec['label']] = $spec['value'];
            }
        }

        $response = Http::withToken(session('api_token'))
            ->put(config('api.base_url')."/barang/{$this->idBarang}", [
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

            foreach ($this->hapusGambarIds as $idHapus) {
                Http::withToken(session('api_token'))
                    ->delete(config('api.base_url')."/gambar/{$idHapus}");
            }

            if (! empty($this->gambar)) {
                $imageRequest = Http::withToken(session('api_token'));
                foreach ($this->gambar as $file) {
                    $imageRequest->attach(
                        'gambar[]',
                        file_get_contents($file->getRealPath()),
                        $file->getClientOriginalName()
                    );
                }
                $imageRequest->post(config('api.base_url').'/gambar', [
                    'id_barang' => $this->idBarang,
                ]);
            }

            $this->isEditing = false;
            $this->gambar = [];
            $this->hapusGambarIds = [];

            $this->redirect(config('app.url')."/produk/detail/{$this->kodeBarang}");
            session()->flash('success', 'Produk berhasil diperbarui.');
        } else {
            session()->flash('error', 'Gagal memperbarui produk. Pastikan semua data benar.');
        }
    }

    public function hapus(string $id): void
    {
        $response = Http::withToken(session('api_token'))
            ->delete(config('api.base_url')."/barang/{$id}");

        if ($response->successful()) {
            session()->flash('success', 'Produk dihapus.');
            $this->redirect(route('produk'), navigate: true);
        }
    }

    public function updatedGambarUploads(): void
    {
        foreach ($this->gambarUploads as $file) {
            $this->gambar[] = $file;
        }
        $this->gambarUploads = [];
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        $apiResponse = $this->fetchRating();
        $rating = $this->buildPaginator($apiResponse);

        return view('livewire.pages.data.detail', ['rating' => $rating]);
    }
}
