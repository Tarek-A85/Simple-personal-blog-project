<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/show/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::view('about/me', 'AboutMe')->name('about_me');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
    
    Route::resources([
        'tags' => TagController::class,
        'categories' => CategoryController::class
    ]);

});





require __DIR__.'/auth.php';
