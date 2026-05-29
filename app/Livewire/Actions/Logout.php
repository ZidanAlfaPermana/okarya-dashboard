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
        $token = session('api_token');
        \auth()->user()->tokens()->where('token', $token)->delete();
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        session()->forget('api_token');
    }
}
