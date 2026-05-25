<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PembayaranController extends Controller
{
    private $pembayaran = Pembayaran::class;

    private $rules = [
        'status' => 'required|in:pending,settlement,cancel,expire',
    ];

    private $rulesIndex = [
        'kode_transaksi' => 'nullable|string',
        'w_item' => 'nullable|string',
        'status' => 'nullable|in:pending,settlement,cancel,expire',
        'payment_type' => 'nullable|string',
        'no_item' => 'nullable|string'
    ];

    private $messages = [
        'required' => ':attribute pembayaran wajib diisi.',
        'in' => ':attribute tidak valid. Pilihan yang diizinkan: pending, settlement, cancel, expire.'
    ];

    private $messagesIndex = [
        'string' => ':attribute tidak valid.',
        'in' => ':attribute harus berisi pending, settlement, cancel, expire.'
    ];

    public function index(Request $request)
    {
        try {
            $request->validate($this->rulesIndex, $this->messagesIndex);
            if ($request->input('kode_transaksi')) {
                if ($request->input('search')) {
                    $data = $this->pembayaran::with(['user'])->whereLike('kode_transaksi', '%'.$request->input('kode_transaksi').'%')->paginate($this->getDefaultDataLimitPerPage());
                    return $this->successResponse($data, 'data pembayaran berhasil diambil sea');
                }
                if ($request->input('w_item')) {
                    $data = $this->pembayaran::with(['item.barang', 'user'])->whereKodeTransaksi($request->input('kode_transaksi'))->first();
                    return $this->successResponse($data, 'data pembayaran berhasil diambil');
                }
                $data = $this->pembayaran::with(['user'])->whereKodeTransaksi($request->input('kode_transaksi'))->first();
                return $this->successResponse($data, 'data pembayaran berhasil diambil');
            }
            if ($request->input('status')) {
                if ($request->input('w_item')) {
                    $data = $this->pembayaran::with(['item.barang', 'user'])->whereStatus($request->status)->paginate($this->getDefaultDataLimitPerPage());
                    return $this->successResponse($data, 'data pembayaran berhasil diambil');
                }
                $data = $this->pembayaran::with(['user'])->whereStatus($request->status)->paginate($this->getDefaultDataLimitPerPage());
                return $this->successResponse($data, 'data pembayaran berhasil diambil');
            }
            if ($request->input('payment_type')) {
                $data = $this->pembayaran::with(['item.barang', 'user'])->wherePaymentType($request->payment_type);
                return $this->successResponse($data, 'data pembayaran berhasil diambil');
            }
            if ($request->input('no_item')) {
                $data = $this->pembayaran::with(['user'])->paginate($this->getDefaultDataLimitPerPage());
                return $this->successResponse($data, 'data berhasil didapat');
            }
            $data = $this->pembayaran::with(['item.barang', 'user'])->paginate($this->getDefaultDataLimitPerPage());
            return $this->successResponse($data, 'data berhasil didapat');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Error validation');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage(), 'Internal server error');
        }
    }

    public function show($id_pembayaran)
    {
        try {
            $pembayaran = $this->idPembayaran($id_pembayaran);
            if (!$pembayaran->exists()) {
                return $this->errorResponse(null, 'unknown', 'data pembayaran tidak ditemukan');
            }
            return $this->successResponse($pembayaran->get(), 'data berhasil diambil');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'error', 'Internal server error');
        }
    }

    public function update(Request $request, $id_pembayaran)
    {
        try {
            $request->validate($this->rules, $this->messages);
            $pembayaran = $this->idPembayaran($id_pembayaran);
            if (!$pembayaran->exists()) {
                return $this->errorResponse(null, 'unknown', 'data pembayaran tidak ditemukan');
            }
            if ($pembayaran->status === 'settlement') {
                return response()->json(['message' => 'Transaksi sudah lunas dan tidak bisa diubah statusnya'], 403);
            }
            $pembayaran->update([
                'status' => $request->status
            ]);
            return $this->successResponse($pembayaran, 'data berhasil diubah');
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Internal server error');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'error', 'Internal server error');
        }
    }

    public function destroy($id_pembayaran)
    {
        try {
            $pembayaran = $this->idPembayaran($id_pembayaran);
            if (!$pembayaran->exists()) {
                return $this->errorResponse(null, 'unknown', 'data pembayaran tidak ditemukan');
            }
            $pembayaran->delete();
            return $this->successResponse(null, 'data berhasil di hapus');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'error', 'internal server error');
        }
    }

    private function idPembayaran(string $id_pembayaran)
    {
        return $this->pembayaran::whereIdPembayaran($id_pembayaran)->first();
    }
}
