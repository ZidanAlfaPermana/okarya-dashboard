<?php

namespace App\Livewire\Pages\Data;

use App\Services\AccountService;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddAccount extends Component
{
    public string $email = '';

    public string $name = '';

    public string $password = '';
    public string $verifyPassword = '';
    public int $telp = 0;
    public array $access = [
        ""
    ];

    public string $level = 'user';

    protected AccountService $service;

    public function boot(): void
    {
        $this->service = new AccountService();
    }

    public function save(): void
    {
        try {
            $this->service->createAccountOrUpdate([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->verifyPassword,
            ]);

            session()->flash('success', 'Akun berhasil ditambahkan.');
            $this->redirect('/account', navigate: true);

        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan akun. Pastikan semua data benar.');
        }
    }

    public function render()
    {
        return view('livewire.pages.data.add_account');
    }
}
