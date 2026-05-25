<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Services\AuthService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Mockery\Exception;

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
            $data = $service->getToken([
                'email' => $this->form->email,
                'password' => $this->form->password,
            ]);
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (Exception) {
            return;
        }

        $this->form->authenticate();

        Session::regenerate();

        if ($data) {
            $token = $data['token'];
            session(['api_token' => $token]);
        }

        $this->redirectIntended(default: route('welcome', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
