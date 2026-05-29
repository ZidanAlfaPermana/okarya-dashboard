<?php

namespace App\Livewire\Pages;

use App\Services\BarangService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class QRCode extends Component
{
    public string $search = '';

    public function render(BarangService $service)
    {
        $perPage = 15;

        try {
            if (isset($search)) {
                $data = $service->getDaftarBarang(['only_qr' => true, 'search' => $search]);
            } else {
                $data = $service->getDaftarBarang(['only_qr' => true]);
            }
        } catch (\Exception $e) {
            return view('livewire.pages.qr_code', [
                'qrcode' => null,
            ]);
        }

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
