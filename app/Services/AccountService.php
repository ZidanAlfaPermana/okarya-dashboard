<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AccountService
{
    private array $rules = [
        'email' => 'email|required|unique:users,email',
        'name' => 'string|required|max:100',
        'password' => 'string|confirmed|required|min:8'
    ];

    private array $message = [
        'email' => ':attribute tidak valid, harap isi email dengan benar',
        'required' => ':attribute harus diisi dan tidak boleh kosong',
        'unique' => ':attribute sudah digunakan',
        'max' => ':attribute max kata :max',
        'min' => ':attribute min kata :min',
        'confirmed' => ':attribute tidak sama atau salah'
    ];

    private string $model = User::class;

    public function getAllAccounts(string $level)
    {
        return match ($level) {
            'upj' => $this->model::whereLevel('upj')->paginate(10),
            'admin' => $this->model::whereLevel('admin')->paginate(10),
            default => $this->model::whereLevel('user')->paginate(10)
        };
    }

    public function createAccountOrUpdate(array $data)
    {
        $validation = Validator::make($data, $this->rules, $this->message);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $clean = $validation->validated();
        $clean['level'] = 'admin';
        $clean['account_verified'] = true;

        $user = $this->model::updateOrCreate($clean['email'], $clean);
        return true;
    }

    public function deleteAccount($email): bool
    {
        return $this->model::where('email', $email)->delete();
    }
}
