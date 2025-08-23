<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExternalController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;






Route::middleware(['auth'])->controller(AdminController::class)->group(function () {
    
});




Route::middleware(['auth'])->controller(ExternalController::class)->group(function () {
   

    Route::get('/in/course/view', 'in_course_view')->name('in.course.view');
    Route::get('/in/course/all', 'in_course_all')->name('in.course.all');
    Route::post('/in/course/add', 'in_course_add')->name('in.course.add');
    Route::post('/in/course/delete/{id}', 'in_course_delete')->name('in.course.delete');
    Route::get('/in/course/edit/{id}', 'in_course_edit')->name('in.course.edit');
    Route::post('/in/course/update/{id}', 'in_course_update')->name('in.course.update');

    Route::get('/in/course/curriculum/{id}',  'in_curriculum')->name('in.course.curriculum');
    Route::get('/in/revenue/',  'in_revenue')->name('in.revenue');

    Route::post('/in/course/{id}/save-curriculum',  'in_saveCurriculum')->name('in.course.saveCurriculum');
    Route::get('/in/profile/view/', 'in_password_view')->name('in.password.view');
    Route::get('/in/payout', 'myPayoutRequests')->name('in.payout');

    Route::post('/in/password/change/', 'in_user_password_change')->name('in.password.change');


});



