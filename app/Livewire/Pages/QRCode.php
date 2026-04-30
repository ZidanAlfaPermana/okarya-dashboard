<?php

namespace App\Livewire\Pages;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class QRCode extends Component
{
    public string $search = '';

    public function render()
    {
        $perPage = 15;

        if (isset($search)) {
            $response = Http::withToken(session('api_token'))->get(config('api.base_url').'/barang', ['qr_only' => true, 'kode_barang' => $this->search]);
        } else {
            $response = Http::withToken(session('api_token'))->get(config('api.base_url').'/barang', ['qr_only' => true]);
        }

        $data = $response->json();
        $items = collect($data['data'] ?? []);

        $qrcode = new LengthAwarePaginator(
            $items,
            $data['total'] ?? $items->count(),
            $perPage,
            options: ['path' => url()->current()]
        );

        return view('livewire.pages.qr_code', [
            'qrcode' => $qrcode,
        ]);
    }
}
