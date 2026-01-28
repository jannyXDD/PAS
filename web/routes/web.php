<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NoteController as AdminNoteController;

/*
| Public
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
| Dashboard
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
| Authenticated user area
*/
Route::middleware('auth')->group(function () {

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Notes
    */

    // All notes (My Notes)
    Route::resource('notes', NoteController::class);

    // Notes by folder (sidebar folders)
    Route::get('/notes/folder/{folder}', [NoteController::class, 'indexByFolder'])
        ->name('notes.byFolder');

    /*
    | Folders
    */
    Route::resource('folders', FolderController::class)->except(['show']);
});

/*
| Admin area
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Users
        Route::resource('users', UserController::class);

        // All notes (admin)
        Route::resource('notes', AdminNoteController::class)->except(['create', 'store']);
    });

require __DIR__.'/auth.php';