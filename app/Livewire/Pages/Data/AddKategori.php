<?php

namespace App\Livewire\Pages\Data;

use App\Services\KategoriService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddKategori extends Component
{
    public string $nama_kategori = '';

    public string $deskripsi = '';

    public string $status = '';

    protected KategoriService $service;

    public function boot(): void
    {
        $this->service = new KategoriService();
    }

    public function save(): void
    {
        try {
            $this->service->createKategori([
                'nama_kategori' => $this->nama_kategori,
                'deskripsi' => $this->deskripsi,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Kategori berhasil ditambahkan.');
            $this->redirect('/kategori', navigate: true);

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan Kategori. Pastikan semua data benar.');
        }
    }

    public function render()
    {
        return view('livewire.pages.data.add_kategori');
    }
}
