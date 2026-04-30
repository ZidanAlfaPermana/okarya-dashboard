<?php

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
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

    public function hapus(string $id): void
    {
        $response = Http::withToken(session('api_token'))
            ->delete(config('api.base_url')."/barang/{$id}");

        if ($response->successful()) {
            session()->flash('success', 'Produk berhasil dihapus.');
        } else {
            session()->flash('error', 'Gagal menghapus produk. Silakan coba lagi.');
        }
    }

    private function fetchProduk(): array
    {
        if ($this->searchBy == 'kode_barang') {
            $response = Http::withToken(session('api_token'))
                ->get(config('api.base_url').'/barang', [
                    'kode_barang' => $this->search,
                ]);
        } else {
            $response = Http::withToken(session('api_token'))
                ->get(config('api.base_url').'/barang', [
                    'nama_barang' => $this->search,
                ]);
        }


        if ($response->failed()) {
            return ['data' => [], 'meta' => [], 'kategori_list' => []];
        }

        return $response->json();
    }

    private function fetchKategori(): array
    {

        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/kategori');

        if ($response->failed()) {
            return ['data' => []];
        }

        return $response->json()['data'];
    }

    private function buildPaginator(array $apiResponse): LengthAwarePaginator
    {
        $perPage = $this->viewMode === 'card' ? 12 : 15;
        $meta = $apiResponse['meta'] ?? [];
        $items = Collection::make($apiResponse['data'] ?? []);

        return new LengthAwarePaginator(
            items: $items,
            total: $meta['total'] ?? $items->count(),
            perPage: $meta['per_page'] ?? $perPage,
            currentPage: $meta['current_page'] ?? $this->getPage(),
            options: [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        $apiResponse = $this->fetchProduk();
        $produk = $this->buildPaginator($apiResponse);
        $kategoriList = $this->fetchKategori();

        return view('livewire.pages.produk', [
            'produk' => $produk,
            'kategoriList' => $kategoriList,
        ]);
    }
}
