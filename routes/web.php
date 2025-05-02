<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('shopping', 'shopping')
        ->middleware(['auth', 'verified'])
        ->name('shopping');

    Route::get('/rooms', function () {
        return view('rooms');
    })->name('rooms');
    //room item detail, wenn man auf ein item klickt was in rooms ist

    Route::get('/items', function () {
        return view('items');
    })->name('items');

    Route::get('/budget', function () {
        return view('budget');
    })->name('budget');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
