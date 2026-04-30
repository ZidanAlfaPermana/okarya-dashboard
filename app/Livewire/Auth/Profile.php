<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->email_verified_at = $user->email_verified_at;
    }

    public function updateProfile(): void
    {
        $user = auth()->user();

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        User::where('id', $user->id)->update($userData);

        $this->password = '';
        $this->password_confirmation = '';

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.pages.auth.profile');
    }
}
