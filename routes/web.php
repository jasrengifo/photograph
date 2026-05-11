<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::get('/gallery/{country:code}', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/galleries', [HomeController::class, 'galleries'])->name('galleries');
Route::get('/latest', [HomeController::class, 'latest'])->name('latest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('countries', \App\Http\Controllers\Backend\CountryController::class);
    Route::resource('albums', \App\Http\Controllers\Backend\AlbumController::class);
    Route::resource('photos', \App\Http\Controllers\Backend\PhotoController::class);
    Route::resource('settings', \App\Http\Controllers\Backend\SettingController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
