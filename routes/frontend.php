<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/courses/detail', 'course_detail')->name('course.detail');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/about', 'about')->name('about');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/career', 'career')->name('career');
    Route::get('/innovation', 'innovation')->name('innovation');
    Route::get('/masterclass', 'masterclass')->name('masterclass');
    Route::get('/hire_grad', 'hire_grad')->name('hire_grad');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/community', 'community')->name('community');
    Route::get('/hire', 'hire')->name('hire');
    Route::get('/consultation', 'consultation')->name('consultation');
    Route::get('/corporate/training', 'corporate_training')->name('corporate_training');

});

require __DIR__.'/auth.php';

