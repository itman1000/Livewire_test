<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTagController;
use App\Services\HotpepperService;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    if (Auth::check()) {
        $user = Auth::user();
        return view('auth.dashboard', ['user' => $user]);
    } else {
        return view('welcome');
    }
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('auth.showLoginForm');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])
        ->name('auth.showRegistrationForm');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('auth.register');
});

Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])
    ->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/restaurants/export', [RestaurantController::class, 'export'])
    ->name('restaurants.export');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('auth.dashboard');
    Route::resource('users', UserController::class);
    Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])
        ->name('restaurants.edit');
    Route::resource('restaurants', RestaurantController::class)->except(['edit']);
    Route::resource('categories', CategoryController::class);
    Route::resource('category-tags', CategoryTagController::class);
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
});
