<?php

namespace App\Livewire\Pages\Print;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FormQrcode extends Component
{
    public $kode_barang = '';
    public $limitMode = 'auto';
    public $customLimit = 1;

    public function render()
    {
        $params = [
            'only_qr' => 'true',
        ];

        if (!empty($this->kode_barang)) {
            $params['kode_barang'] = $this->kode_barang;
        }

        if ($this->limitMode === 'custom' && $this->customLimit > 0) {
            $params['limit'] = $this->customLimit;
        } else {
            $params['limit'] = 'auto';
        }

        $response = Http::withToken(session('api_token'))
            ->get(config('api.base_url').'/barang', $params);

        $data = $response->json();
        $items = $data['data'] ?? [];

        return view('livewire.pages.print.qrcode', ['qrcode' => $items]);
    }
}
