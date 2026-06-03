<?php

use App\Livewire\Pages\Data\AddKategori;
use App\Livewire\Pages\Data\AddProduk;
use App\Livewire\Pages\Data\DetailPesanan;
use App\Livewire\Pages\Detail;
use App\Livewire\Pages\Guide;
use App\Livewire\Pages\Kategori;
use App\Livewire\Pages\Pesanan;
use App\Livewire\Pages\Print\FormBarang;
use App\Livewire\Pages\Print\FormQrcode;
use App\Livewire\Pages\Produk;
use App\Livewire\Pages\QRCode;
use App\Livewire\Pages\Welcome;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', Welcome::class)->name('welcome');
    Route::get('produk', Produk::class)->name('produk');
    Route::get('produk/detail/{id}', Detail::class)->name('produk.detail');
    Route::get('produk/create', AddProduk::class)->name('produk.create');
    Route::get('kategori', Kategori::class)->name('kategori');
    Route::get('kategori/create', AddKategori::class)->name('kategori.create');
    Route::get('kategori/edit/{id}', App\Livewire\Pages\Data\Kategori::class)->name('kategori.edit');
    Route::get('qrcode', QRCode::class)->name('qrcode');
    Route::get('print/form', FormBarang::class)->name('print.form');
    Route::get('print/qrcode', FormQrcode::class)->name('print.qrcode');
    Route::get('pesanan', Pesanan::class)->name('pesanan');
    Route::get('pesanan/detail/{id}', DetailPesanan::class)->name('pesanan.detail');
    Route::get('guide', Guide::class)->name('guide');
});

require __DIR__.'/auth.php';
