<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
