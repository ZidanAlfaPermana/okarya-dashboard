<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Authenticated extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(AuthService $service): void
    {
        $this->validate();
        try {
            $service->login([
                'email' => $this->form->email,
                'password' => $this->form->password,
            ], true);
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());

            return;
        }

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('welcome', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
