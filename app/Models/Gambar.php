<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gambar extends Model
{
    public $timestamps = false;

    protected $table = 'gambar_barang';
    protected $primaryKey = 'gambar_id';
    protected $fillable = ['id_barang', 'gambar'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
