<?php

namespace App\Livewire\Auth;

use App\Livewire\Actions\Logout;
use Livewire\Component;

class LogoutButton extends Component
{
    public function logot(Logout $logout)
    {
        $logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.logout-button');
    }
}
