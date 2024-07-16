<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');

    Route::view('notes', 'notes.index')->name('notes.index');
});


require __DIR__ . '/auth.php';
