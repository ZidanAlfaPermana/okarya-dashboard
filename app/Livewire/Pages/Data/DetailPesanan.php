<?php

namespace App\Livewire\Pages\Data;

use App\Services\PembayaranService;
use Livewire\Component;

class DetailPesanan extends Component
{
    public string $kodeTransaksi;

    protected PembayaranService $pembayaranService;

    public function mount(string $id): void
    {
        $this->kodeTransaksi = $id;
    }

    public function konfirmasiPembayaran(): void
    {
        try {
            $this->pembayaranService->updateStatus($this->pembayaranService->getPembayaranIDFromKodeTransaksi($this->kodeTransaksi), ['status' => 'settlement']);
            session()->flash('success', 'Pembayaran tunai berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function batalkanTransaksi(): void
    {
        try {
            $this->pembayaranService->updateStatus($this->pembayaranService->getPembayaranIDFromKodeTransaksi($this->kodeTransaksi), ['status' => 'cancel']);
            session()->flash('success', 'Transaksi berhasil dibatalkan.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        try {
            $response = $this->pembayaranService->getPembayaranById($this->pembayaranService->getPembayaranIDFromKodeTransaksi($this->kodeTransaksi));
            $pembayaran = $response['data']->load(['item.barang', 'user']);
        } catch (\Exception $e) {
            session()->flash('error', 'Transaksi tidak ditemukan.');

            return view('livewire.pages.data.detail_transaksi', ['pembayaran' => null]);
        }

        return view('livewire.pages.data.detail_transaksi', [
            'pembayaran' => $pembayaran,
        ]);
    }
}
