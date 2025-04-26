<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/about', 'about')->name('about');

});

require __DIR__.'/auth.php';

