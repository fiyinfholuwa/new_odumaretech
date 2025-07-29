<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;





Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/courses', 'courses')->name('courses');
    Route::get('/courses/detail/{name}', 'course_detail')->name('course.detail');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/about', 'about')->name('about');
    Route::get('/faq', 'faq')->name('faq');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/career', 'career')->name('career');
    Route::get('/innovation', 'innovation')->name('innovation');
    Route::get('/innovation/{id}', 'innovation')->name('innovation.info');
    Route::get('/masterclass', 'masterclass')->name('masterclass');
    Route::get('/hire/grad', 'hire_grad')->name('hire_grad');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');
    Route::post('/instructor/add', 'instructor_add')->name('instructor.add');
    Route::get('/community', 'community')->name('community');
    Route::get('/hire', 'hire')->name('hire');
    Route::get('/consultation', 'consultation')->name('consultation');
    Route::get('/marketplace', 'marketplace')->name('marketplace');
    Route::get('/course/listing', 'course_list')->name('course_list');
    Route::get('/corporate/training', 'corporate_training')->name('corporate_training');
    Route::get('/course/external/detail/{name}', 'course_external_detail')->name('course_external_detail');
});

require __DIR__.'/auth.php';

