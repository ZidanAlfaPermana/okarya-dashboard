<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FavoriteController extends Controller
{
    private string $favorite = Favorite::class;

    private array $rules = [
        'id_barang' => 'required|exists:barang,id_barang',
    ];

    private array $messages = [
        'required' => ':attribute tidak boleh kosong',
        'exists' => ':attribute tidak ditemukan',
    ];

    public function index()
    {
        try {
            $user = auth()->id();
            $data = $this->favorite::with(['barang'])->whereUserId($user)->paginate($this->getDefaultDataLimitPerPage());
            return $this->successResponse($data, 'data favorite berhasil ditampilkan');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server Error');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate($this->rules, $this->messages);
            $user = auth()->id();
            $favorite = $this->favorite::whereUserId($user)->whereBarangId($request->id_barang)->first();
            if ($favorite) {
                return $this->errorResponse(null, 'duplicate entry', 'Item sudah ditambahkan ke favorite', 422);
            }
            $data = $this->favorite::create([
                'user_id' => $user,
                'id_barang' => $request->id_barang,
            ]);
            return $this->successResponse($data, 'data favorite berhasil ditambahkan');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server Error');
        }
    }

    public function destroy($id)
    {
        try {
            $user = auth()->id();
            $favorite = $this->favorite::whereUserId($user)->whereFavoriteId($id)->first();
            if ($favorite) {
                $favorite->delete();
                return $this->successResponse(null, 'data favorite berhasil dihapus');
            } else {
                return $this->errorResponse(null, 'unknown', 'data favorite tidak ditemukan', 404);
            }
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server Error');
        }
    }
}
