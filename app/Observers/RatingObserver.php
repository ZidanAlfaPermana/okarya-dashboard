<?php

namespace App\Observers;

use App\Models\Barang;
use App\Models\Rating;

class RatingObserver
{
    public function created(Rating $rating): void
    {
        $this->updateBarangRating($rating->id_barang);
    }

    public function updated(Rating $rating): void
    {
        $this->updateBarangRating($rating->id_barang);
    }

    public function deleted(Rating $rating): void
    {
        $this->updateBarangRating($rating->id_barang);
    }

    private function updateBarangRating($barangId): void
    {
        $barang = Barang::find($barangId);
        if ($barang) {
            $barang->rating_avg = $barang->ratings()->avg('rating') ?? 0;
            $barang->rating_count = $barang->ratings()->count();
            $barang->save();
        }
    }
}
