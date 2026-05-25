<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembayaran extends Model
{

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'user_id',
        'total',
        'kode_transaksi',
        'keterangan',
        'status',
        'payment_type',
    ];

    public function item(): HasMany
    {
        return $this->hasMany(ItemTransaction::class, 'id_pembayaran', 'id_pembayaran');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
