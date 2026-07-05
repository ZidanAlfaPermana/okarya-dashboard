<?php

namespace App\Services;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $user = User::updateOrCreate(['email' => $clean['email']], [
            'name' => $clean['name'],
            'email' => $clean['email'],
            'password' => Hash::make($clean['password']),
        ]);

        if (! $this->createNewOtp($user)) {
            return [
                'message' => 'Silahkan Verifikasi lagi',
                'success' => true,
            ];
        }

        return [
            'message' => 'Registrasi berhasil jika sudah verifikasi. udh kekirim ya',
            'success' => true,
        ];

        /*return [
            'token' => $this->createToken($user),
            'user' => $user->get(['email', 'name']),
            'message' => 'Registrasi berhasil',
            'success' => true,
        ];*/
    }

    public function revokeToken(User $user): array
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

        if ($user->level !== config('app.privileges.admin')) {
            throw ValidationException::withMessages([
                'form.email' => ['Akun anda tidak ditemukan. Hubungi admin jika ini merupakan kesalahan'],
            ]);
        }

        $user->update(['last_session' => Carbon::now()->toDateTimeString()]);

        return true;
    }

    public function createNewOtp(string $email)
    {
        $user = User::where('email', $email)->first();
        if (! $user) {
            return false;
        }
        $is_otp_available = $user->value('otp_code');
        if ($is_otp_available && $this->isExpired($user->value('otp_expires_at'))) {
            return false;
        }
        $otp = random_int(100000, 999999);
        $user->update([
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(15),
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return true;
    }

    public function verifyOtp(string $otp)
    {
        $otp_user = User::where('otp_code', $otp)->first();
        return $otp_user && $this->isExpired($otp_user->value('otp_expires_at'));
    }

    private function isExpired($otp_expires_at): bool
    {
        return now()->lessThanOrEqualTo($otp_expires_at);
    }
}
