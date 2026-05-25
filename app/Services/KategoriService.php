<?php

namespace App\Services;

use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class KategoriService
{
    private array $rules = [
        'nama_kategori' => 'required|string|min:3|max:200',
        'deskripsi' => 'required|string|min:3|max:500',
        'status' => 'required|in:aktif,nonaktif,draft',
    ];

    private array $messages = [
        'required' => ':attribute tidak boleh kosong',
        'string' => ':attribute harus berupa string',
        'min' => ':attribute tidak boleh kurang dari :min',
        'max' => ':attribute tidak boleh lebih dari :max',
        'in' => ':attribute tidak valid',
    ];

    public function getKategori(array $filters = [], int $limit = 10)
    {
        $query = Kategori::query();

        if (! empty($filters['nama_kategori'])) {
            $query->where('nama_kategori', 'like', '%'.$filters['nama_kategori'].'%');
        }

        if (! empty($filters['status']) && in_array($filters['status'], ['aktif', 'nonaktif', 'draft'])) {
            $query->where('status', $filters['status']);
        }

        return [
            'data' => $query->paginate($limit),
            'message' => 'Data berhasil diambil',
        ];
    }

    public function createKategori(array $data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return [
            'data' => Kategori::create($validator->validated()),
            'message' => 'Data berhasil ditambah',
        ];
    }

    public function getKategoriById($id)
    {
        $kategori = Kategori::find($id);

        if (! $kategori) {
            throw new \Exception('Data kategori tidak ditemukan', 404);
        }

        return [
            'data' => $kategori,
            'message' => 'Data berhasil diambil',
        ];
    }

    public function updateKategori($id, array $data)
    {
        $validator = Validator::make($data, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $kategori = Kategori::find($id);

        if (! $kategori) {
            throw new \Exception('Data kategori tidak ditemukan', 404);
        }

        $kategori->update($validator->validated());

        return [
            'data' => clone $kategori,
            'message' => 'Data berhasil diubah',
        ];
    }

    public function deleteKategori($id)
    {
        $kategori = Kategori::find($id);

        if (! $kategori) {
            throw new \Exception('Data kategori tidak ditemukan', 404);
        }

        $kategori->delete();

        return [
            'data' => null,
            'message' => 'Data berhasil dihapus',
        ];
    }
}
