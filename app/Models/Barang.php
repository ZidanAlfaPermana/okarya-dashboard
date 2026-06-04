<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_barang';
    protected $appends = ['qr_code_full_url'];
    public $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga',
        'kode_barang',
        'stok',
        'specification',
        'id_kategori',
        'qr_code',
        'penyimpanan',
        'rating',
        'status',
        'description',
    ];

    protected function casts()
    {
        return [
            'specification' => 'array',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'id_barang');
    }

    public function gambar(): HasMany
    {
        return $this->hasMany(Gambar::class, 'id_barang');
    }

    protected function qrCodeFullUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->qr_code) {
                    return asset('storage/' . $this->qr_code);
                }
                return null;
            }
        );
    }
}
