<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => 'Token berhasil dihapus (Logout sukses)',
                'success' => true,
            ]);
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan', 500);
        }
    }

    public function createToken(User $user)
    {
        return $user->createToken('token-for-api')->plainTextToken;
    }
}
