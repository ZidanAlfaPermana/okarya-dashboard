<?php

namespace App\Livewire\Pages;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Pesanan extends Component
{
    use WithPagination;

    public $pembayaran = [];

    private function fetchPesanan()
    {
        return [];
    }

    private function buildPaginator(array $apiResponse): LengthAwarePaginator
    {
        $perPage = 15;

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

    public function render()
    {
        $data = $this->buildPaginator($this->fetchPesanan());
        return view('livewire.pages.pesanan', ['pembayaran' => $data]);
    }
}
