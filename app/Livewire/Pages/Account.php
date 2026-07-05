<?php

namespace App\Livewire\Pages;

use App\Services\AccountService;
use Livewire\Component;
use Livewire\WithPagination;

class Account extends Component
{
    use WithPagination;
    public string $search = '';
    public string $level = 'admin';
    protected AccountService $service;

    public function boot()
    {
        $this->service = new AccountService();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function konfirmasiBatal($email)
    {
        $this->dispatch('open-confirm',
            title: 'Hapus Akun?',
            message: 'Apakah Anda yakin ingin menghapus akun dengan email '.$email.'? Data akun ini tidak bisa dikembalikan lagi.',
            type: 'danger',
            method: 'hapus',
            params: $email,
            componentId: $this->getId()
        );
    }

    public function hapus($email)
    {
        try {
            $this->service->deleteAccount($email);
            session()->flash('success', 'Akun berhasil dihapus.');
        } catch (\Exception) {
            session()->flash('failed', 'Gagal menghapus akun, terjadi kesalahan.');
        }
    }

    public function render()
    {
        $data = $this->service->getAllAccounts($this->level);
        return view('livewire.pages.account', ['account' => $data]);
    }
}
