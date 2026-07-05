<?php

namespace App\Services;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PembayaranService
{
    private array $rules = [
        'status' => 'required|in:pending,settlement,cancel,expire',
    ];

    private array $messages = [
        'status.required' => 'Status pembayaran wajib diisi.',
        'status.in' => 'Status tidak valid. Pilihan yang diizinkan: pending, success, cancel, expire.',
    ];

    public function getPembayaran(array $filters = [], int $limitPerPage = 10)
    {
        $validator = Validator::make($filters, [
            'kode_transaksi' => 'nullable|string',
            'search' => 'nullable|string',
            'w_item' => 'nullable|boolean',
            'status' => 'nullable|in:pending,success,cancel,expire',
            'payment_type' => 'nullable|string',
            'no_item' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $query = Pembayaran::query();

        if (! empty($filters['no_item'])) {
            $query->with(['user']);
        } else {
            $query->with(['item.barang', 'user']);
        }

        if (! empty($filters['search'])) {
            $input = $filters['search'];

            $query->where(function ($q) use ($input) {
                $q->where('kode_transaksi', 'like', '%'.$input.'%')
                    ->orWhere('kode_transaksi', 'like', '%'.$input.'-%');
            });

            return [
                'data' => $query->paginate($limitPerPage),
                'message' => 'Data pembayaran berhasil diambil',
            ];
        }

        if (! empty($filters['kode_transaksi'])) {

            $data = $query->where('kode_transaksi', $filters['kode_transaksi'])->first();

            return [
                'data' => $data,
                'message' => 'Data pembayaran berhasil diambil',
            ];
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['payment_type'])) {
            $query->where('payment_type', $filters['payment_type']);
        }

        return [
            'data' => $query->paginate($limitPerPage),
            'message' => 'Data berhasil didapat',
        ];
    }

    public function getPembayaranById($id)
    {
        $pembayaran = Pembayaran::whereIdPembayaran($id)->first();

        if (! $pembayaran) {
            throw new \RuntimeException('Data pembayaran tidak ditemukan', 404);
        }

        return [
            'data' => $pembayaran,
            'message' => 'Data berhasil diambil',
        ];
    }

    public function updateStatus($id, array $data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $pembayaran = Pembayaran::where('id_pembayaran', $id)->first();

        if (! $pembayaran) {
            throw new \RuntimeException('Data pembayaran tidak ditemukan', 404);
        }

        if ($pembayaran->status === 'settlement') {
            throw new \RuntimeException('Transaksi sudah lunas dan tidak bisa diubah statusnya', 403);
        }

        $pembayaran->update([
            'status' => $data['status'],
        ]);

        return [
            'data' => clone $pembayaran,
            'message' => 'Data berhasil diubah',
        ];
    }

    public function deletePembayaran($id)
    {
        $pembayaran = Pembayaran::where('id_pembayaran', $id)->first();

        if (! $pembayaran) {
            throw new \RuntimeException('Data pembayaran tidak ditemukan', 404);
        }

        $pembayaran->delete();

        return [
            'data' => null,
            'message' => 'Data berhasil dihapus',
        ];
    }

    public function getPembayaranIDFromKodeTransaksi($kode_transaksi)
    {
        $kode = Pembayaran::whereKodeTransaksi($kode_transaksi)->first();
        if (! $kode) {
            throw new \RuntimeException('Data pembayaran tidak ditemukan', 404);
        }

        return $kode->id_pembayaran;
    }

    public static function getCountOfPendingPembayaran()
    {
        $data = Pembayaran::whereStatus('pending')->count();
        return $data > 99 ? '99+' : $data;
    }
}
