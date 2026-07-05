<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthenticatedController extends Controller
{
    public function getToken(Request $request, AuthService $service)
    {
        try {
            $data = $service->getToken($request->all());

            return response()->json($data);
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->errors(), 'Validation Error');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server Error');
        }
    }

    public function RegisterToken(Request $request, AuthService $service)
    {
        try {
            $data = $service->register($request->all());

            return response()->json($data);
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->errors(), 'Validation Error');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server Error');
        }
    }

    public function revokeToken(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return $this->successResponse(null, 'Token berhasil dihapus (Logout sukses)');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan', 500);
        }
    }

    public function mailTesting(Request $request, AuthService $service)
    {
        try {
            if (! $service->createNewOtp($request->user()->email)) {
                return $this->errorResponse(null, 'exists', 'Kode OTP sudah ada, harap isi otp terlebih dahulu, atau menunggu kode OTP kedaluarsa');
            }

            return $this->successResponse(null, 'Kode OTP berhasil terkirim');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan', 500);
        }
    }

    public function checkOTP(Request $request, AuthService $service)
    {
        try {
            $validation = $request->validate(['otp' => 'required|string|max:6'], ['otp.required' => 'Kode OTP tidak boleh kosong', 'otp.string' => 'Kode OTP harus berupa string', 'otp.max' => 'Kode OTP hanya berisi 6 kata saja']);
            if (! $service->verifyOtp($validation['otp'])) {
                return $this->errorResponse(null, 'expired or undefined', 'Kode OTP tidak valid atau sudah kadaluarsa');
            }

            return $this->successResponse(null, 'Kode OTP cocok dan akun terverifikasi');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Validation Error');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan', 500);
        }
    }
}
