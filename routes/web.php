<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// User Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // User Profile and Reservations
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/reservations', [UserController::class, 'reservationHistory'])->name('reservations');
    });

    // Reservation Routes
    Route::prefix('films/{screening}')->name('reservations.')->group(function () {
        Route::get('/reserve', [ReservationController::class, 'create'])->name('create');
        Route::post('/reserve', [ReservationController::class, 'store'])->name('store');
    });

    // General Reservation Management
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

// Films Resource Routes
Route::resource('films', FilmController::class);

// Screenings Resource Routes
Route::resource('screenings', ScreeningController::class);

// Reservation Success Page
Route::get('/reservations/success', [ReservationController::class, 'success'])->name('reservations.success');

Route::get('/users/reservations', [UserController::class, 'reservationHistory'])->name('user.reservations');

Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('pages.contact');