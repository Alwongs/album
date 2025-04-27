<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/share-link', [ShareController::class, 'generateAccessLink'])->name('share-link');
Route::get('/link-for-friend/{login}/{password}', [ShareController::class, 'loginFriend'])->name('link-for-friend');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/news', function () {
    return view('news');
})->name('news');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {
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
