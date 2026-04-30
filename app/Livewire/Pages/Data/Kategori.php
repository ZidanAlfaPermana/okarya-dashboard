<?php

namespace App\Livewire\Pages\Data;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Kategori extends Component
{
    public int $idKategori;

    public string $namaKategori = '';

    public string $deskripsiKategori = '';

    public $status = '';

    public function mount(string $id): void
    {
        $this->idKategori = $id;
        $this->fetchData();
    }

    private function fetchData(): void
    {
        $response = Http::withToken(session('api_token'))->get(config('api.base_url').'/kategori/'.$this->idKategori);
        $this->namaKategori = $response->json('data')[0]['nama_kategori'] ?? '';
        $this->deskripsiKategori = $response->json('data')[0]['deskripsi'] ?? '';
        $this->status = $response->json('data')[0]['status'] ?? '';
    }

    public function save(): void
    {
        $response = Http::withToken(session('api_token'))
            ->put(config('api.base_url')."/kategori/{$this->idKategori}", [
                'nama_kategori' => $this->namaKategori,
                'deskripsi' => $this->deskripsiKategori,
                'status' => $this->status,
            ]);

        if ($response->successful()) {
            $this->redirect(config('app.url').'/kategori');
            session()->flash('success', 'Kategori berhasil diperbarui.');
        } else {
            session()->flash('error', 'Gagal memperbarui Kategori. Pastikan semua data benar.');
        }
    }

    public function hapus(string $id): void
    {
        $response = Http::withToken(session('api_token'))
            ->delete(config('api.base_url')."/kategori/{$id}");

        if ($response->successful()) {
            session()->flash('success', 'Kategori dihapus.');
            $this->redirect(route('kategori'), navigate: true);
        }
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.data.edit_kategori');
    }
}
