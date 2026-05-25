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

    public function hapus(string $id, BarangService $barangService): void
    {
        try {
            $barangService->deleteItem($id);
            session()->flash('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus produk. Silakan coba lagi.');
        }
    }

    public function render(BarangService $barangService, KategoriService $kategoriService): View|Factory|\Illuminate\View\View
    {
        $limitPerPage = $this->viewMode === 'card' ? 12 : 15;

        $filters = [];

        if (! empty($this->search)) {
            $filters[$this->searchBy] = $this->search;
        }

        if (! empty($this->kategori)) {
            $filters['id_kategori'] = $this->kategori;
        }

        $produkResponse = $barangService->getDaftarBarang($filters, $limitPerPage);
        $kategoriResponse = $kategoriService->getKategori([], 100);

        return view('livewire.pages.produk', [
            'produk' => $produkResponse['data'],
            'kategoriList' => $kategoriResponse['data']->items(),
        ]);
    }
}
