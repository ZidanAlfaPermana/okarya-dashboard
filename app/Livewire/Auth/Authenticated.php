<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Authenticated extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $response = Http::post('http://localhost:8001/api/user/token', [
            'email' => $this->form->email,
            'password' => $this->form->password,
        ]);

        if ($response->successful()) {
            $token = $response->json()['token'];
            session(['api_token' => $token]);
        }

        $this->redirectIntended(default: route('welcome', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
