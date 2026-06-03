<?php

namespace App\Livewire\Pages;

use App\Models\Rating;
use App\Services\BarangService;
use App\Services\KategoriService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
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

    public function mount(string $id, KategoriService $kategoriService, BarangService $barangService): void
    {
        $this->kodeBarang = $id;
        $this->loadKategori($kategoriService);
        $this->loadProduk($barangService);
    }

    public function changeImageMode(string $mode): void
    {
        $this->imageMode = $mode;
        session(['image_view_mode' => $mode]);
    }

    public function konfirmasiBatal($id_barang, $nama_barang)
    {
        $this->dispatch('open-confirm',
            title: 'Hapus Barang?',
            message: 'Apakah Anda yakin ingin menghapus barang '.$nama_barang.'? Data barang ini tidak bisa dikembalikan lagi.',
            type: 'danger',
            method: 'hapus',
            params: $id_barang
        );
    }

    private function loadKategori(KategoriService $kategoriService): void
    {
        $response = $kategoriService->getKategori([], 100);

        $this->kategoriList = collect($response['data']->items())->toArray();
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

    private function loadProduk(BarangService $barangService): void
    {
        $response = $barangService->getDaftarBarang(['kode_barang' => $this->kodeBarang], 1);
        $data = $response['data']->first();

        if (! $data) {
            session()->flash('error', 'Produk tidak ditemukan.');
            $this->redirect('/produk', navigate: true);

            return;
        }

        $this->nama = $data->nama_barang ?? '';
        $this->idBarang = $data->id_barang ?? 0;
        $this->harga = (int) ($data->harga ?? 0);
        $this->stok = (int) ($data->stok ?? 0);
        $this->penyimpanan = $data->penyimpanan ?? '';

        $this->existingGambar = $data->gambar ? $data->gambar->toArray() : [];

        $this->idKategori = $data->id_kategori ?? 0;
        $this->namaKategori = $data->kategori->nama_kategori ?? 'Tanpa Kategori';
        $this->status = $data->status ?? 'aktif';

        $this->gambarUrl = collect($this->existingGambar)->pluck('gambar')->toArray() ?? [];
        $this->gambarQrCode = $data->qr_code_full_url ?? '';

        $specs = is_string($data->specification) ? json_decode($data->specification, true) : ($data->specification ?? []);
        $this->specification = $specs;

        $this->specList = [];
        if (is_array($specs)) {
            foreach ($specs as $key => $value) {
                $this->specList[] = ['label' => $key, 'value' => $value];
            }
        }

        $this->statistik = [
            'rating_avg' => $data->rating_avg ?? 0,
            'rating_count' => $data->rating_count ?? 0,
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

    public function setMode(string $mode, BarangService $barangService): void
    {
        if ($mode === 'edit') {
            $this->isEditing = true;
        } else {
            $this->isEditing = false;
            $this->resetValidation();
            $this->gambar = [];
            $this->hapusGambarIds = [];
            $this->loadProduk($barangService);
        }
    }

    public function save(BarangService $barangService): void
    {
        $formattedSpecs = [];
        foreach ($this->specList as $spec) {
            if (! empty($spec['label'])) {
                $formattedSpecs[$spec['label']] = $spec['value'];
            }
        }

        try {
            foreach ($this->hapusGambarIds as $idHapus) {
                $barangService->deleteGambarSingle($idHapus);
            }

            $barangService->updateItem($this->idBarang, [
                'nama_barang' => $this->nama,
                'kode_barang' => $this->kodeBarang,
                'id_kategori' => (int) $this->idKategori,
                'harga' => (int) $this->harga,
                'stok' => (int) $this->stok,
                'penyimpanan' => $this->penyimpanan,
                'specification' => $formattedSpecs,
                'status' => $this->status ?: 'aktif',
                'gambar' => $this->gambar,
            ]);

            $this->isEditing = false;
            $this->gambar = [];
            $this->hapusGambarIds = [];

            session()->flash('success', 'Produk berhasil diperbarui.');
            $this->redirect("/produk/detail/{$this->kodeBarang}", navigate: true);

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui produk: '.$e->getMessage());
        }
    }

    public function hapus(string $id, BarangService $barangService): void
    {
        try {
            $barangService->deleteItem($id);
            session()->flash('success', 'Produk dihapus.');
            $this->redirect('/produk', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus produk: '.$e->getMessage());
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
        $rating = Rating::with('user')
            ->where('id_barang', $this->idBarang)
            ->paginate(5);

        return view('livewire.pages.data.detail', ['rating' => $rating]);
    }
}
