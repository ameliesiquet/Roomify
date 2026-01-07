<?php

use App\Livewire\Pages\Budget\Budget;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Items\Items;
use App\Livewire\Pages\Profile\Profile;
use App\Livewire\Pages\Rooms\Rooms;
use App\Livewire\Pages\Shopping\Shopping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/shopping', Shopping::class)->name('shopping');
    Route::get('/rooms', Rooms::class)->name('rooms');
    //room item detail, wenn man auf ein item klickt was in rooms ist
    Route::get('/items', Items::class)->name('items');
    Route::get('/budget', Budget::class)->name('budget');
    Route::get('/profile', Profile::class)->name('profile');

});

require __DIR__.'/auth.php';
