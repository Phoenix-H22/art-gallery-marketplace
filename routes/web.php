<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtworkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/paintings', [ArtworkController::class, 'index'])->name('paintings.index');
Route::get('/artwork/{id}', [ArtworkController::class, 'show'])->name('artwork.show');

// Search Routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/api/live-search', [SearchController::class, 'liveSearch'])->name('live.search');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile');
Route::get('/artist/{id}', [ProfileController::class, 'show'])->name('artist.profile');
