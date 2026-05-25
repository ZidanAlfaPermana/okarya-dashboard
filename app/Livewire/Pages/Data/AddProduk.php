<?php

namespace App\Livewire\Pages\Data;

use App\Services\BarangService;
use App\Services\KategoriService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduk extends Component
{
    use WithFileUploads;

    public $kodeBarang;

    public string $nama = '';

    public $gambarUploads = [];

    public $idKategori;

    public string $namaKategori = '';

    public string $penyimpanan = '';

    public array $gambar = [];

    public int $harga = 0;

    public int $stok = 0;

    public string $status = 'draft';

    public array $specList = [];

    public array $kategoriList = [];

    public array $statistik = [];

    public array $specification = [];

    public function mount(KategoriService $kategoriService): void
    {
        $response = $kategoriService->getKategori([], 99999);
        $this->kategoriList = $response['data']->items();
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

    public function updatedGambarUploads(): void
    {
        foreach ($this->gambarUploads as $file) {
            $this->gambar[] = $file;
        }
        $this->gambarUploads = [];
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
            $barangService->createItem([
                'nama_barang' => $this->nama,
                'kode_barang' => $this->kodeBarang,
                'id_kategori' => (int) $this->idKategori,
                'harga' => (int) $this->harga,
                'stok' => (int) $this->stok,
                'penyimpanan' => $this->penyimpanan,
                'specification' => $formattedSpecs,
                'status' => $this->status ?: 'draft',
                'gambar' => $this->gambar,
            ]);

            session()->flash('success', 'Produk dan Gambar berhasil ditambahkan.');
            $this->redirect("/produk/detail/{$this->kodeBarang}", navigate: true);

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            $this->redirect('/produk/', navigate: true);
            session()->flash('error', 'Gagal memperbarui produk. Pastikan semua data benar.');
        }
    }

    public function render()
    {
        return view('livewire.pages.data.add_produk');
    }
}
