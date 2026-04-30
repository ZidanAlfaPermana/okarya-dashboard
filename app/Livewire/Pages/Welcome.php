<?php

namespace App\Livewire\Pages;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Welcome extends Component
{

    public function render()
    {
        return view('welcome');
    }
}
