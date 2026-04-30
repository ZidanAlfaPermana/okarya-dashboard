<?php

namespace App\Livewire\Pages\Print;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FormQrcode extends Component
{
    public function render()
    {
        $response = Http::withToken(session('api_token'))->get(config('api.base_url').'/barang', ['qr_only' => true]);
        $data = $response->json();
        $items = $data['data'] ?? [];

        return view('livewire.pages.print.qrcode', ['qrcode' => $items]);
    }
}
