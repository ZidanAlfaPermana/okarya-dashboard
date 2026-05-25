<?php

namespace App\Models;

use App\Observers\RatingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([RatingObserver::class])]
class Rating extends Model
{
    protected $table = 'rating';

    protected $primaryKey = 'rating_id';
    protected $fillable = ['user_id', 'id_barang', 'rating', 'keterangan'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

}
