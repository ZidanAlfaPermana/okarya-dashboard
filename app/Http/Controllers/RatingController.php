<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RatingController extends Controller
{
    private string $rating = Rating::class;

    private array $rules = [
        'user_id' => 'required|exists:users,id',
        'id_barang' => 'required|exists:barang,id_barang',
        'rating' => 'required|numeric|min:1|max:5',
        'keterangan' => 'required|string|max:255',
    ];

    private array $messages = [
        'required' => ':attribute tidak boleh kosong',
        'numeric' => ':attribute harus berupa angka',
        'min' => ':attribute minimal :min',
        'max' => ':attribute maksimal :max',
        'exists' => ':attribute tidak ditemukan'
    ];

    private array $rulesIndex = [
        'user_id' => 'nullable|exists:users,id',
        'id_barang' => 'nullable|exists:barang,id_barang',
        'filter' => 'nullable|in:1,2,3,4,5',
    ];

    private array $messagesIndex = [
        'exists' => ':attribute tidak ditemukan',
        'in' => ':attribute harus 1, 2, 3, 4, atau 5',
    ];

    public function index(Request $request)
    {
        try {
            $request->validate($this->rulesIndex, $this->messagesIndex);
            $data = $this->rating::with('user');
            $user_id = $request->input('user_id');
            $filter = $request->input('filter');
            $id_barang = $request->input('id_barang');
            if (isset($user_id)) {
                if (isset($filter)) {
                    return $this->successResponse($data->whereRating($filter)->whereUserId($user_id)->paginate($this->getDefaultDataLimitPerPage()), 'data ditemukan');
                }
                return $this->successResponse($data->whereUserId($user_id)->paginate($this->getDefaultDataLimitPerPage()), 'data berhasil diambil');
            }
            if (isset($id_barang)) {
                if (isset($filter)) {
                    return $this->successResponse($data->whereRating($filter)->whereIdBarang($id_barang)->paginate($this->getDefaultDataLimitPerPage()), 'data ditemukan');
                }
                return $this->successResponse($data->whereIdBarang($id_barang)->paginate($this->getDefaultDataLimitPerPage()), 'data berhasil diambil');
            }
            if (isset($filter)) {
                return $this->successResponse($data->whereRating($filter)->paginate($this->getDefaultDataLimitPerPage()), 'data ditemukan untuk '.$filter);
            }
            return $this->successResponse($data->paginate($this->getDefaultDataLimitPerPage()), 'data berhasil diambil');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception) {
            return $this->errorResponse(null, 'internal', 'error', 500);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate($this->rules, $this->messages);
            if ($this->isRatingAlreadyExists($request->input('user_id'), $request->input('id_barang'))) {
                return $this->errorResponse(null, 'already exists', 'Mohon maaf user ini sudah memberi rating', 409);
            }
            $data = $this->rating::create($request->all());
            return $this->successResponse($data, 'data berhasil ditambah');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'internal', 'error', 500);
        }
    }

    public function show($id) {
        try {
            if (!$this->isIRatingIdExists($id)) {
                return $this->errorResponse(null, 'id tidak ditemukan', 'error', 404);
            }
            return $this->successResponse($this->rating::with('user')->find($id)->first(), 'data berhasil diambil');
        } catch (\Exception) {
            return $this->errorResponse(null, 'internal', 'error', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (!$this->isIRatingIdExists($id)) {
                return $this->errorResponse(null, 'id tidak ditemukan', 'error', 404);
            }
            $request->validate($this->rules, $this->messages);
            $rating = $this->rating::find($id);
            $rating->update($request->all());
            return $this->successResponse($rating, 'data berhasil diupdate');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception) {
            return $this->errorResponse(null, 'internal', 'error', 500);
        }
    }
    public function destroy($id) {
        try {
            if (!$this->isIRatingIdExists($id)) {
                return $this->errorResponse(null, 'id tidak ditemukan', 'error', 404);
            }
            $rating = $this->rating::find($id);
            $rating->delete();
            return $this->successResponse(null, 'data berhasil dihapus');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        }
    }

    private function isIRatingIdExists($rating_id) {
        return $this->rating::whereRatingId($rating_id)->exists();
    }

    private function isRatingAlreadyExists($id_user, $id_barang) {
        return $this->rating::whereUserId($id_user)->whereIdBarang($id_barang)->exists();
    }
}
