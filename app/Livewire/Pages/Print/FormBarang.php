<?php

namespace App\Livewire\Pages\Print;

use Livewire\Component;

class FormBarang extends Component
{
    public int $startNumber = 1;
    public function render()
    {
        return view('livewire.pages.print.form_barang');
    }
}
