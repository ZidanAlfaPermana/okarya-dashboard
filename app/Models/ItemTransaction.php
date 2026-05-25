<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemTransaction extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_item_transaction';
    protected $fillable = [
        'id_barang',
        'user_id',
        'qty',
        'id_pembayaran',
        'harga_satuan'
    ];

    protected $table = 'item_transaction';

    public function items()
    {
        return $this->belongsToMany(Barang::class, 'transaction_items')
            ->withPivot('harga');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
