<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function getToken(array $data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email:dns,rfc',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Kredensial yang diberikan salah/account salah.'],
            ]);
        }

        return [
            'token' => $this->createToken($user),
            'user' => $user,
            'message' => 'Token berhasil didapatkan',
            'success' => true,
        ];
    }

    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return [
            'token' => $this->createToken($user),
            'user' => $user,
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
        return $user->createToken('token-for-api')->plainTextToken;
    }
}
