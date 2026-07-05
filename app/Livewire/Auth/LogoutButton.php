<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LogoutButton extends Component
{
    public function konfirmasiBatal()
    {
        $this->dispatch('open-confirm',
            title: 'Anda yakin ingin logout?',
            message: 'Apakah Anda yakin ingin keluar dari aplikasi ini? anda dapat masuk lagi ke dalam aplikasi dengan akun anda.',
            type: 'danger',
            method: 'logout',
            componentId: $this->getId()
        );
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.pages.auth.logout-button');
    }
}
