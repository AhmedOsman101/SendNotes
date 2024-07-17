<?php

use App\Models\Note;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::view('profile', 'profile')
        ->name('profile');


    Route::prefix('notes')->group(function () {

        Route::get('/', function () {

            return view('notes.index', [
                'notesCount' => Auth::user()->notes()->count()
            ]);
        })->name('notes.index');

        Route::view('create', 'notes.create')->name('notes.create');

        Volt::route('/{id}/edit', 'notes.edit-notes')->name('notes.edit');

        Route::get('/{id}', function (string $id) {
            $note = Note::find($id);

            return view('notes.view', [
                'note' => $note
            ]);
        })->name('notes.view');
    });
});


require __DIR__ . '/auth.php';
