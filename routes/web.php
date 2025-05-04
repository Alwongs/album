<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/link-for-friend/{login}/{password}', [ShareController::class, 'loginFriend'])->name('link-for-friend');

Route::get('/news', function () {
    return view('pages.news');
})->name('news');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/different-information', [AdminController::class, 'index'])->name('admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([ 
        'categories' => CategoryController::class,
        'photos'     => PhotoController::class,
        'users'      => UserController::class
    ]);
});

require __DIR__.'/auth.php';
