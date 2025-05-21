<?php

use App\Livewire\Pages\Dashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/shopping', Dashboard::class)->name('shopping');
    Route::get('/rooms', Dashboard::class)->name('rooms');
    //room item detail, wenn man auf ein item klickt was in rooms ist
    Route::get('/items', Dashboard::class)->name('items');
    Route::get('/budget', Dashboard::class)->name('budget');
    Route::get('/profile', Dashboard::class)->name('profile');
});

require __DIR__.'/auth.php';
