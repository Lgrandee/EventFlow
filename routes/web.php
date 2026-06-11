<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'store']) ->middleware('auth')->name('events.register');

Route::get('/UserDashboard', function () {return view('UserDashboard.index');})->middleware('auth')->name('UserDashboard');
Route::get('/AdminDashboard', function () {return view('AdminDashboard.index');})->middleware('auth')->name('AdminDashboard');
Route::get('/OrganizerDashboard', function () {return view('OrganizerDashboard.index');})->middleware('auth')->name('OrganizerDashboard');