<?php

namespace App\Livewire\Pages;

use Illuminate\Http\Request;
use Livewire\Component;

class Guide extends Component
{
    public function render(Request $request)
    {
        return match ($request->page) {
            'barang' => view('livewire.pages.guides.barang'),
            'kategori' => view('livewire.pages.guides.kategori'),
            'pesanan' => view('livewire.pages.guides.pesanan'),
            'laporan' => view('livewire.pages.guides.laporan'),
            default => view('livewire.pages.guide'),
        };
    }
}
