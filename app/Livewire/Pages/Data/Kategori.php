<?php

namespace App\Livewire\Pages\Data;

use App\Services\KategoriService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Kategori extends Component
{
    public int $idKategori;

    public string $namaKategori = '';

    public string $deskripsiKategori = '';

    public string $status = '';

    public function mount(string $id, KategoriService $kategoriService): void
    {
        $this->idKategori = (int) $id;
        $this->loadData($kategoriService);
    }

    private function loadData(KategoriService $kategoriService): void
    {
        try {
            $response = $kategoriService->getKategoriById($this->idKategori);
            $kategori = $response['data'];

            $this->namaKategori = $kategori->nama_kategori ?? '';
            $this->deskripsiKategori = $kategori->deskripsi ?? '';
            $this->status = $kategori->status ?? '';
        } catch (\Exception $e) {
            session()->flash('error', 'Kategori tidak ditemukan.');
            $this->redirect('/kategori', navigate: true);
        }
    }

    public function save(KategoriService $kategoriService): void
    {
        try {
            $kategoriService->updateKategori($this->idKategori, [
                'nama_kategori' => $this->namaKategori,
                'deskripsi' => $this->deskripsiKategori,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Kategori berhasil diperbarui.');
            $this->redirect('/kategori', navigate: true);
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui Kategori. Pastikan semua data benar.');
        }
    }

    public function hapus(string $id, KategoriService $kategoriService): void
    {
        try {
            $kategoriService->deleteKategori($id);
            session()->flash('success', 'Kategori dihapus.');
            $this->redirect('/kategori', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus kategori.');
        }
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.pages.data.edit_kategori');
    }
}
