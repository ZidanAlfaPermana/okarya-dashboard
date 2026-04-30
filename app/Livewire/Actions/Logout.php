<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        $token = session('api_token');
        Http::withToken($token)->post('http://localhost:8001/api/user/revoke-token');
        session()->forget('api_token');
    }
}
