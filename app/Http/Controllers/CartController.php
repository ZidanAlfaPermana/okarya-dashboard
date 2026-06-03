<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    private $cart = Cart::class;

    private $rules = [
        'id_barang' => 'required|exists:barang,id_barang',
        'qty' => 'required|integer|min:1',
    ];

    private $messages = [
        'id_barang.required' => 'Barang harus dipilih.',
        'id_barang.exists' => 'Barang tidak ditemukan dalam sistem.',
        'qty.required' => 'Jumlah barang wajib diisi.',
        'qty.integer' => 'Jumlah barang harus berupa angka.',
        'qty.min' => 'Jumlah minimal adalah 1.',
    ];

    public function index(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $carts = $this->cart::with('barang')->whereUserId($userId)->paginate($this->getDefaultDataLimitPerPage());

            return $this->successResponse($carts, 'Data cart berhasil diambil');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server error');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate($this->rules, $this->messages);
            $userId = $request->user()->id;
            $cart = $this->cart::whereUserId($userId)
                ->whereIdBarang($request->id_barang)
                ->first();
            if ($cart) {
                $cart->update(['qty' => $cart->qty + $request->qty]);
            } else {
                $cart = $this->cart::create([
                    'user_id' => $userId,
                    'id_barang' => $request->id_barang,
                    'qty' => $request->qty,
                ]);
            }

            return $this->successResponse($cart, 'data cart berhasil ditambahkan');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Terdapat data blm lengkap');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server error');
        }
    }

    public function destroy(Request $request, $id_cart)
    {
        try {
            $userId = $request->user()->id;
            $cart = $this->cart::where('user_id', $userId)->where('id_cart', $id_cart)->first();
            if (! $cart) {
                return response()->json(['message' => 'Item keranjang tidak ditemukan'], 404);
            }
            $cart->delete();

            return $this->successResponse(null, 'Data berhasil di hapus');
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Internal Server error');
        }
    }
}
