<?php

namespace App\Livewire\Pages;

use App\Services\PembayaranService;
use Livewire\Component;
use Livewire\WithPagination;

class Pesanan extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'pending';

    protected PembayaranService $service;

    public function boot()
    {
        $this->service = new PembayaranService();
    }

    public function render()
    {
        $filters = [];

        if (! empty($this->search)) {
            $filters['search'] = $this->search;
        }

        if (! empty($this->status)) {
            $filters['status'] = $this->status;
        }

        $data = $this->service->getPembayaran($filters);

        return view('livewire.pages.pesanan', ['pembayaran' => $data['data']]);
    }
}
