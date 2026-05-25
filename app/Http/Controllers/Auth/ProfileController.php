<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $user = User::class;

    public function getProfile(Request $request)
    {
        try {
            $data = $request->user();
            return $this->successResponse($data, 'Data berhasil ditemukan');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'error', $e->getMessage());
        }
    }
}
