<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Midtrans\PaymentController;
use App\Http\Controllers\Midtrans\PembayaranController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:20,1')->group(function () {
    Route::post('user/token', [AuthenticatedController::class, 'getToken']);
    Route::post('user/revoke-token', [AuthenticatedController::class, 'revokeToken'])->middleware('auth:sanctum');
    Route::post('user/register', [AuthenticatedController::class, 'RegisterToken']);
});

Route::middleware(['throttle:60,1', 'auth:sanctum'])->group(function () {
    Route::get('user/profile', [ProfileController::class, 'getProfile']);
    Route::post('midtrans/charge', [PaymentController::class, 'process']);
    Route::post('midtrans/callback', [PaymentController::class, 'callback']);
});

Route::middleware(['auth:sanctum', 'throttle:60,1', 'ability:customer-okarya'])->group(function () {

    Route::get('barang', [BarangController::class, 'index']);
    Route::get('barang/{id}', [BarangController::class, 'show']);
    Route::get('kategori', [KategoriController::class, 'index']);

    Route::get('rating', [RatingController::class, 'index']);
    /*Route::get('rating/{id}', [RatingController::class, 'show']);*/
    Route::post('rating', [RatingController::class, 'store']);
    Route::put('rating/{id}', [RatingController::class, 'update']);

    Route::get('pembayaran', [PembayaranController::class, 'index']);
    Route::get('pembayaran/{id_pembayaran}', [PembayaranController::class, 'show']);

    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart', [CartController::class, 'store']);
    Route::delete('cart/{cart_id}', [CartController::class, 'destroy']);

    Route::get('favorite', [FavoriteController::class, 'index']);
    Route::post('favorite', [FavoriteController::class, 'store']);
    Route::delete('favorite/{id}', [FavoriteController::class, 'destroy']);
});
