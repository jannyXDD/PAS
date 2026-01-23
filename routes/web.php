<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('notes', NoteController::class);

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::resource('users', UserController::class);

    Route::get('/notes', [AdminNoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/{note}', [AdminNoteController::class, 'show'])->name('notes.show');
    Route::get('/notes/{note}/edit', [AdminNoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}', [AdminNoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [AdminNoteController::class, 'destroy'])->name('notes.destroy');
});

require __DIR__.'/auth.php';
