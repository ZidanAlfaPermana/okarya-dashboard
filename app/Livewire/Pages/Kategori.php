<?php

namespace App\Livewire\Pages;

use App\Services\KategoriService;
use App\Services\PembayaranService;
use Livewire\Component;
use Livewire\WithPagination;

class Kategori extends Component
{
    use WithPagination;

    public string $search = '';

    protected KategoriService $service;

    public function boot(): void
    {
        $this->service = new KategoriService();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function konfirmasiBatal($id_kategori, $nama_kategori)
    {
        $this->dispatch('open-confirm',
            title: 'Hapus Kategori?',
            message: 'Apakah Anda yakin ingin menghapus kategori '.$nama_kategori.'? Data kategori ini tidak bisa dikembalikan lagi.',
            type: 'danger',
            method: 'hapus',
            params: $id_kategori,
            componentId: $this->getId()
        );
    }

    public function hapus(string $idKategori): void
    {
        try {
            $this->service->deleteKategori($idKategori);
            session()->flash('success', 'Kategori berhasil dihapus.');
        } catch (\Exception) {
            session()->flash('failed', 'Gagal menghapus kategori');
        }
    }

    public function render()
    {
        $filters = [];

        if (! empty($this->search)) {
            $filters['nama_kategori'] = $this->search;
        }

        $response = $this->service->getKategori($filters, 10);

        return view('livewire.pages.kategori', [
            'kategori' => $response['data'],
        ]);
    }
}
