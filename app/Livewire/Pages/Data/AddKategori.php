<?php

namespace App\Livewire\Pages\Data;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddKategori extends Component
{
    public string $nama_kategori = '';

    public string $deskripsi = '';

    public string $status;

    public function save(): void
    {
        $response = Http::withToken(session('api_token'))
            ->post(config('api.base_url').'/kategori', [
                'nama_kategori' => $this->nama_kategori,
                'deskripsi' => $this->deskripsi,
                'status' => $this->status,
            ]);

        if ($response->successful()) {
            $this->redirect(config('app.url').'/kategori');
            session()->flash('success', 'Kategori berhasil ditambahkan.');
        } else {
            session()->flash('error', 'Gagal menambahkan Kategori. Pastikan semua data benar.');
        }
    }

    public function render()
    {
        return view('livewire.pages.data.add_kategori');
    }
}
