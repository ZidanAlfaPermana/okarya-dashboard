<?php

namespace App\Livewire\Pages;

use App\Services\BarangService;
use App\Services\KategoriService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Produk extends Component
{
    use WithPagination;

    public string $viewMode = 'card';

    public string $search = '';

    public string $kategori = '';

    public string $searchBy = 'nama_barang';

    protected BarangService $barangService;
    protected KategoriService $kategoriService;

    public function boot(): void
    {
        $this->barangService = new BarangService();
        $this->kategoriService = new KategoriService();
    }

    public function mount(): void
    {
        $this->viewMode = session('produk_view_mode', 'card');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingKategori(): void
    {
        $this->resetPage();
    }

    public function toggleView(string $mode): void
    {
        $this->viewMode = $mode;
        session(['produk_view_mode' => $mode]);
    }

    public function konfirmasiBatal($id_produk, $nama_barang)
    {
        $this->dispatch('open-confirm',
            title: 'Hapus Produk?',
            message: 'Apakah Anda yakin ingin menghapus produk '.$nama_barang.'? Data produk ini tidak bisa dikembalikan lagi.',
            type: 'danger',
            method: 'hapus',
            params: $id_produk,
            componentId: $this->getId()
        );
    }

    public function hapus(string $id): void
    {
        try {
            $this->barangService->deleteItem($id);
            session()->flash('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus produk. Silakan coba lagi.');
        }
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        $limitPerPage = $this->viewMode === 'card' ? 12 : 15;

        $filters = [];

        if (! empty($this->search)) {
            $filters[$this->searchBy] = $this->search;
        }

        if (! empty($this->kategori)) {
            $filters['id_kategori'] = $this->kategori;
        }

        $produkResponse = $this->barangService->getDaftarBarang($filters, $limitPerPage);
        $kategoriResponse = $this->kategoriService->getKategori([], 100);

        return view('livewire.pages.produk', [
            'produk' => $produkResponse['data'],
            'kategoriList' => $kategoriResponse['data']->items(),
        ]);
    }
}
