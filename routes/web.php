<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Public Event Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [EventController::class, 'index'])
    ->name('home');

Route::get('/events', [EventController::class, 'index'])
    ->name('events.index');

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');

/*
|--------------------------------------------------------------------------
| Event Registration
|--------------------------------------------------------------------------
*/

Route::post('/events/{event}/register', [EventController::class, 'register'])
    ->middleware('auth')
    ->name('events.register');

/*
|--------------------------------------------------------------------------
| Dashboards
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/UserDashboard', function () {
        return view('UserDashboard.index');
    })->name('UserDashboard');

    Route::get('/OrganizerDashboard', function () {
        return view('OrganizerDashboard.index');
    })->name('OrganizerDashboard');

    Route::get('/AdminDashboard', function () {
        return view('AdminDashboard.index');
    })->name('AdminDashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Event Management
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Event overview
    Route::get('/AdminDashboard/event', [EventController::class, 'adminIndex'])
        ->name('EventAdminController');

    // Create event
    Route::get('/AdminDashboard/create', [EventController::class, 'create'])
        ->name('events.create');

    Route::post('/AdminDashboard/store', [EventController::class, 'store'])
        ->name('events.store');

    // View event details
    Route::get('/AdminDashboard/show/{event}', [EventController::class, 'adminShow'])
        ->name('AdminController.show');

    // Edit event
    Route::get('/AdminDashboard/edit/{event}', [EventController::class, 'edit'])
        ->name('events.edit');

    Route::put('/AdminDashboard/update/{event}', [EventController::class, 'update'])
        ->name('events.update');

    // Delete event
    Route::delete('/AdminDashboard/delete/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy');


});
