<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// AUTHENTICATIE ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// PUBLIEKE ROUTES
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/confirm', [EventController::class, 'confirm'])->name('events.confirm');

// BEVEILIGDE ROUTES
Route::middleware(['auth'])->group(function () {
    // Deelnemer
    Route::get('/UserDashboard', [EventController::class, 'userEvents'])->name('UserDashboard');
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    Route::delete('/events/{event}/unregister', [RegistrationController::class, 'destroy'])->name('events.unregister');

    // Admin & Organizer
    Route::prefix('admin')->group(function () {
        Route::get('/admin-dashboard', [AuthController::class, 'AdminDashboard'])->name('AdminDashboard');
        Route::get('/organizer-dashboard', [AuthController::class, 'OrganizerDashboard'])->name('OrganizerDashboard');

        // Events
        Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events');
        Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
        Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
        Route::get('/events/{event}', [EventController::class, 'adminShow'])->name('admin.events.show');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });
});