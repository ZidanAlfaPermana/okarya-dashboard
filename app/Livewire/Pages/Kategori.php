<?php

namespace App\Livewire\Pages;

use App\Services\KategoriService;
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

    public function hapus(string $idKategori, KategoriService $service): void
    {
        try {
            $service->deleteKategori($idKategori);
            session()->flash('success', 'Kategori berhasil dihapus.');
        } catch (\Exception) {
            session()->flash('failed', 'Gagal menghapus kategori');
        }
    }

    public function render(KategoriService $kategoriService)
    {
        $filters = [];

        if (! empty($this->search)) {
            $filters['nama_kategori'] = $this->search;
        }

        if (! empty($this->status)) {
            $filters['status'] = $this->status;
        }

        $response = $kategoriService->getKategori($filters, 10);

        return view('livewire.pages.kategori', [
            'kategori' => $response['data'],
        ]);
    }
}
