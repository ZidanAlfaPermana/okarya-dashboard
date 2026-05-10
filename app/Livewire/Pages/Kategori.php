<?php

namespace App\Livewire\Pages;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Kategori extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function hapus(string $idKategori): void
    {
        $response = Http::withToken(session('api_token'))
            ->delete(config('api.base_url')."/kategori/{$idKategori}");

        if ($response->successful()) {
            session()->flash('success', 'Kategori berhasil dihapus.');
        } else {
            session()->flash('error', 'Gagal menghapus Kategori.');
        }
    }

    /**
     * @throws ConnectionException
     */
    public function render()
    {
        $perPage = 10;
        $currentPage = $this->getPage();

        $params = [
            'page' => $currentPage,
        ];

        if (! empty($this->search)) {
            $params['nama_kategori'] = $this->search;
        }

        if (! empty($this->status)) {
            $params['status'] = $this->status;
        }

        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/kategori', $params);

        $data = $response->json()['data'] ?? [];
        $items = collect($data['data'] ?? []);

        $kategori = new LengthAwarePaginator(
            $items,
            $data['total'] ?? $items->count(),
            $data['per_page'] ?? $perPage,
            $currentPage,
            ['path' => url()->current()]
        );

        return view('livewire.pages.kategori', [
            'kategori' => $kategori,
        ]);
    }
}
