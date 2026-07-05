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

    private array $rulesIndex = [
        'is_favorite' => 'nullable|exists:barang,id_barang',
    ];

    private array $messagesIndex = [
        'is_favorite.exists' => 'kode barang tidak ditemukan',
    ];

    public function index(Request $request)
    {
        try {
            $request->validate($this->rulesIndex, $this->messagesIndex);
            $user = $request->user()->id;
            if ($request->exists('is_favorite')) {
                $favorite = $this->favorite::whereUserId($user)->whereIdBarang($request->is_favorite)->first();

                return $this->successResponse(['is_favorite' => (bool) $favorite], 'berhasil ambil data favorite');
            }
            $data = $this->favorite::with(['barang', 'barang.gambarUtama'])->whereUserId($user)->paginate($this->getDefaultDataLimitPerPage());

            return $this->successResponse($data, 'data favorite berhasil ditampilkan');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Validation Error');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage(), 'Internal Server Error');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate($this->rules, $this->messages);
            $user = $request->user()->id;
            $favorite = $this->favorite::whereUserId($user)->whereIdBarang($request->id_barang)->first();
            if ($favorite) {
                $data = $favorite->delete();

                return $this->successResponse($data, 'data favorite berhasil dihapus');
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
}
