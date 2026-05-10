<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';

    public string $email = '';

    public $email_verified_at;

    public string $password = '';

    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->fetchProfile();
    }

    public function fetchProfile(): void
    {
        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/user/profile');
        $data = $response->json()['data'];
        if ($response->ok() || $response->successful()) {
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->email_verified_at = $data['email_verified_at'];
        } else {
            $this->name = '';
            $this->email = '';
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.profile');
    }
}
