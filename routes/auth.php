<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\Authenticated;
use App\Livewire\Auth\Profile;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', Authenticated::class)
        ->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('user/profile', Profile::class)
        ->name('user.profile');
});
