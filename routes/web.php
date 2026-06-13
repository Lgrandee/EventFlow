<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publieke Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/confirm', [EventController::class, 'confirm'])->name('events.confirm');

/*
|--------------------------------------------------------------------------
| Beveiligde Routes (Ingetogd verplicht)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Deelnemer Dashboard & Acties
    Route::get('/UserDashboard', [EventController::class, 'userEvents'])->name('userevent');
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'destroy'])->name('events.unregister');

    /*
    |--------------------------------------------------------------------------
    | MANAGEMENT PANEEL (Alleen voor Organizer en Admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        
        // Evenementenbeheer (Voor Organizer en Admin)
        Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events');
        Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
        Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
        Route::get('/events/{event}', [EventController::class, 'adminShow'])->name('admin.events.show');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
        
        // Categorieënbeheer (Specifiek voor de Organisator & Admin)
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Alleen de Admin mag events écht verwijderen
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    });
});