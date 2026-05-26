<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Gambar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangService
{
    private function rules($isUpdate = false, $id = null)
    {
        return [
            'id_kategori' => 'required|integer|exists:kategori,id_kategori',
            'nama_barang' => 'required|string|min:3|max:200',
            'harga' => 'required|integer|min:1',
            'kode_barang' => 'required|string|unique:barang,kode_barang'.($isUpdate ? ','.$id.',id_barang' : ''),
            'stok' => 'required|integer|min:1',
            'specification' => 'required|array',
            'penyimpanan' => 'required|string|min:3|max:200',
            'status' => 'required|string|in:aktif,nonaktif,draft',

            'gambar' => ($isUpdate ? 'nullable' : 'required').'|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    private $messages = [
        'required' => ':attribute tidak boleh kosong',
        'integer' => ':attribute harus berupa integer',
        'min' => ':attribute tidak boleh kurang dari :min',
        'max' => ':attribute tidak boleh lebih dari :max',
        'unique' => ':attribute sudah digunakan',
        'exists' => ':attribute tidak ditemukan',
        'array' => ':attribute tidak valid',
        'in' => ':attribute tidak valid, hanya menerima aktif, nonaktif, atau draft',
    ];

    public function getDaftarBarang(array $filters = [], $limitPerPage = 10): array
    {
        if (isset($filters['aktif_only'])) {
            $filters['aktif_only'] = filter_var($filters['aktif_only'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }
        $validator = Validator::make($filters, [
            'nama_barang' => 'nullable|string|max:200',
            'qr_code' => 'nullable',
            'kode_barang' => 'nullable|string|min:1|max:200',
            'only_qr' => 'nullable',
            'limit' => 'nullable',
            'id_kategori' => 'nullable|exists:kategori,id_kategori',
            'aktif_only' => 'nullable|boolean:true,false',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (isset($filters['qr_code'])) {
            $barang = Barang::where('kode_barang', $filters['qr_code'])->first();
            if (! $barang) {
                throw new \Exception('Barang tidak ditemukan', 404);
            }

            return [
                'data' => $barang->qr_code_full_url,
                'message' => 'QR berhasil di temukan',
            ];
        }

        if (isset($filters['only_qr'])) {
            if (isset($filters['kode_barang'])) {
                $limit = ($filters['limit'] ?? null) == 'auto'
                    ? Barang::whereLike('kode_barang', $filters['kode_barang'])->value('stok')
                    : ($filters['limit'] ?? null);

                $qr = Barang::whereLike('kode_barang', $filters['kode_barang'])->get(['qr_code', 'kode_barang']);

                if (isset($limit)) {
                    $data = collect()->times($limit, function () use ($qr) {
                        return $qr;
                    })->collapse()->all();
                } else {
                    $data = $qr;
                }

                return [
                    'data' => $data,
                    'message' => 'Qr Berhasil didapatkan dengan kode barang '.$filters['kode_barang'],
                ];
            }

            return [
                'data' => Barang::get(['qr_code', 'kode_barang']),
                'message' => 'QR berhasil di temukan',
            ];
        }

        $query = Barang::with(['kategori', 'ratings', 'gambar']);

        if (isset($filters['nama_barang'])) {
            $query->whereLike('nama_barang', '%'.$filters['nama_barang'].'%');
            $message = 'Data barang berhasil diambil dengan nama';
        } elseif (isset($filters['kode_barang'])) {
            $query->whereLike('kode_barang', '%'.$filters['kode_barang'].'%');
            $message = 'Data barang berhasil diambil dengan kode barang';
        } elseif (isset($filters['id_kategori'])) {
            $query->where('id_kategori', $filters['id_kategori']);
            $message = 'Data barang berhasil diambil dengan id kategori';
        } elseif (isset($filters['aktif_only']) && $filters['aktif_only']) {
            $query->whereStatus('aktif');
            $message = 'Data barang berhasil diambil dengan status aktif';
        } else {
            $message = 'Data barang berhasil diambil';
        }

        return [
            'data' => $query->paginate($limitPerPage),
            'message' => $message,
        ];
    }

    public function createItem(array $data)
    {
        $validator = Validator::make($data, $this->rules(false), $this->messages);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $barang = Barang::create($validator->validated());

        $kode_barang = strtoupper($barang->kode_barang);
        $f_name = $this->createQRCode($kode_barang);
        $barang->update(['qr_code' => $f_name]);

        if (isset($data['gambar']) && is_array($data['gambar'])) {
            $this->uploadGambar($barang->id_barang, $data['gambar']);
        }

        return [
            'data' => clone $barang,
            'message' => 'Barang dan gambar berhasil ditambahkan',
        ];
    }

    public function getItem($id)
    {
        $barang = Barang::with(['kategori', 'ratings', 'gambar'])->find($id);

        if (! $barang) {
            throw new \Exception('Barang tidak ditemukan', 404);
        }

        return [
            'data' => $barang,
            'message' => 'Barang berhasil diambil',
        ];
    }

    public function updateItem($id, array $data)
    {
        $validator = Validator::make($data, $this->rules(true, $id), $this->messages);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $barang = Barang::find($id);
        if (! $barang) {
            throw new \Exception('Barang tidak ditemukan', 404);
        }

        $oldKode = strtoupper($barang->kode_barang);
        $newKode = strtoupper($data['kode_barang'] ?? $oldKode);

        if ($oldKode !== $newKode) {
            if (Storage::disk('public')->exists('qr_codes/'.$oldKode.'.svg')) {
                Storage::disk('public')->delete('qr_codes/'.$oldKode.'.svg');
            }
            $f_name = $this->createQRCode($newKode);
            $data['qr_code'] = $f_name;
        }

        $barang->update($data);

        if (isset($data['gambar']) && is_array($data['gambar'])) {
            $this->uploadGambar($barang->id_barang, $data['gambar']);
        }

        return [
            'data' => clone $barang,
            'message' => 'Data barang berhasil diubah',
        ];
    }

    public function deleteItem($id)
    {
        $barang = Barang::with('gambar')->find($id);
        if (! $barang) {
            throw new \Exception('Barang tidak ditemukan', 404);
        }

        if ($barang->gambar) {
            foreach ($barang->gambar as $g) {
                $path = str_replace(asset('storage/'), '', $g->gambar);
                Storage::disk('public')->delete($path);
                $g->delete();
            }
        }

        $kode = strtoupper($barang->kode_barang);
        if (Storage::disk('public')->exists('qr_codes/'.$kode.'.svg')) {
            Storage::disk('public')->delete('qr_codes/'.$kode.'.svg');
        }

        $barang->delete();

        return [
            'data' => null,
            'message' => 'Data Barang dan seluruh gambarnya berhasil dihapus',
        ];
    }

    public function deleteGambarSingle($id_gambar)
    {
        $gambar = Gambar::find($id_gambar);
        if (! $gambar) {
            throw new \Exception('Gambar tidak ditemukan', 404);
        }

        $path = str_replace(asset('storage/'), '', $gambar->gambar);
        Storage::disk('public')->delete($path);

        $gambar->delete();

        return [
            'data' => null,
            'message' => 'Berhasil menghapus satu gambar',
        ];
    }

    private function uploadGambar($id_barang, $files)
    {
        foreach ($files as $file) {
            $filename = Str::random(30).'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('produk', $filename, 'public');

            Gambar::create([
                'id_barang' => $id_barang,
                'gambar' => asset('storage/'.$path),
            ]);
        }
    }

    private function createQRCode($kode_barang)
    {
        $f_name = 'qr_codes/'.$kode_barang.'.svg';
        $qr_code = QrCode::size(200)->margin(2)->generate($kode_barang);

        Storage::disk('public')->put($f_name, $qr_code);

        return $f_name;
    }
}
