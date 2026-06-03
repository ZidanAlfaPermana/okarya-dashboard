<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private $rules = [
        'email' => 'required|email:dns,rfc',
        'password' => 'required|string',
    ];

    private $messages = [
        'required' => ':attribute tidak boleh kosong',
        'email' => ':attribute tidak valid',
        'string' => ':attribute tidak valid',
    ];

    private $registerRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email:rfc,dns|unique:users,email',
        'password' => 'required|string|confirmed',
    ];

    private $registerMessages = [
        'required' => ':attribute tidak boleh kosong',
        'email' => ':attribute tidak valid',
        'confirmed' => ':attribute tidak sama',
        'unique' => ':attribute coba email yang lain ya',
        'max' => ':attribute tidak boleh lebih dari :max',
        'string' => ':attribute harus berupa text',
    ];

    public function getToken(array $data, bool $isAdmin = false)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $clean = $validator->validated();

        $user = User::where('email', $clean['email'])->first();

        if (! $user || ! Hash::check($clean['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Akun anda tidak ditemukan. buat akun dulu yuk.'],
            ]);
        }

        return [
            'token' => $this->createToken($user),
            'user' => $user->email,
            'message' => 'Token berhasil didapatkan',
            'success' => true,
        ];
    }

    public function register(array $data)
    {
        $validator = Validator::make($data, $this->registerRules, $this->registerMessages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $clean = $validator->validated();

        $user = User::create([
            'name' => $clean['name'],
            'email' => $clean['email'],
            'password' => Hash::make($clean['password']),
        ]);

        return [
            'token' => $this->createToken($user),
            'user' => $user->get(['email', 'name']),
            'message' => 'Registrasi berhasil',
            'success' => true,
        ];
    }

    public function revokeToken(User $user)
    {
        $user->currentAccessToken()->delete();

        return [
            'message' => 'Token berhasil dihapus (Logout sukses)',
        ];
    }

    public function createToken(User $user)
    {
        return $user->createToken('token-for-api', [
            'customer-okarya',
        ])->plainTextToken;
    }

    public function login(array $data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $clean = $validator->validated();

        $user = User::where('email', $clean['email'])->first();

        if (! $user || ! Hash::check($clean['password'], $user->password)) {
            throw ValidationException::withMessages([
                'form.email' => ['Akun anda tidak ditemukan. Hubungi admin jika ini merupakan kesalahan'],
            ]);
        }

        if ($user->level != config('app.privileges.admin')) {
            throw ValidationException::withMessages([
                'form.email' => ['Akun anda tidak ditemukan. Hubungi admin jika ini merupakan kesalahan'],
            ]);
        }

        return true;
    }
}
