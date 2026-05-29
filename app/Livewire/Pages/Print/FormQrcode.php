<?php

namespace App\Livewire\Pages\Print;

use App\Services\BarangService;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FormQrcode extends Component
{
    public $kode_barang = '';
    public $limitMode = 'auto';
    public $customLimit = 1;

    public function render(BarangService $service)
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

        try {
            $data = $service->getDaftarBarang($params);
        } catch (\Exception $e) {
            return view('livewire.pages.print.qrcode', ['qrcode' => null]);
        }
        $items = $data['data'] ?? [];

        return view('livewire.pages.print.qrcode', ['qrcode' => $items]);
    }
}
