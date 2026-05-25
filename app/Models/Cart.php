<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    public $timestamps = false;

    protected $table = 'cart';

    protected $primaryKey = 'id_cart';

    protected $fillable = [
        'id_barang',
        'qty',
        'user_id'
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
