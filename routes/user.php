<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->controller(UserController::class)->group(function () {
    Route::get('/user/resources/view', 'resource_view')->name('resource.view');
    Route::get('/user/resources/details/{id}/{co}', 'resource_detail')->name('resource.detail');
    Route::get('/user/course/active', 'course_active')->name('course.active');
    Route::get('/user/course/completed', 'course_complete')->name('course.complete');
    Route::get('/user/session/view', 'session_view')->name('session.view');
    Route::get('/user/sessions/all/{id}/{co}', 'session_all')->name('session.all');
    Route::get('/user/notification/view', 'notification_view')->name('notification.view');
    Route::get('/user/notification/all/{id}/{co}', 'notification_all')->name('notification.all');
    Route::get('/user/assignment/view', 'assignment_view_user')->name('assignment.user.view');
    Route::get('/user/assignment/all/{id}/{co}', 'assignment_user_all')->name('assignment.user.all');
    Route::get('/user/assignment/submit/{id}', 'assignment_submit')->name('assignment.submit');
    Route::post('/user/assignment/submit/save/{id}', 'assignment_submit_user')->name('assignment.submit.user');
    Route::get('/user/assignment/submitted', 'assignment_submitted')->name('assignment.submitted.user');
    Route::get('/user/chat/view', 'chat_user_view')->name('chat.user.view');
    Route::get('/user/chat/all', 'chat_user_all')->name('chat.user.all');
    Route::post('/user/chat/add', 'chat_user_add')->name('chat.user.add');
    Route::get('/user/chat/reply/{id}', 'user_chat_reply_view')->name('chat.user.read');
    Route::get('/user/github/', 'user_github')->name('user.github');
    Route::get('/user/records/view', 'record_user_view')->name('record.user.view');
    Route::get('/user/record/all/{id}/{co}', 'user_record')->name('records.user.all');
    Route::get('/user/password/view/', 'user_password_view')->name('user.password.view');
    Route::post('/user/password/change/', 'user_password_change')->name('user.password.change');
    Route::get('/user/transactions/all', 'transactions_user')->name('transaction.user.all');

    Route::get('/user/project/view', 'project_view_user')->name('project.user.view');
    // Route::get('/user/assignment/all/{id}', 'assignment_user_all')->name('assignment.user.all');
    Route::get('/user/project/submit/{id}/{co}', 'project_submit')->name('project.submit');
    Route::post('/user/project/submit/save/{id}', 'project_submit_user')->name('project.submit.user');
    Route::get('/user/project/submitted', 'project_submitted')->name('project.submitted.user');
    Route::get('/user/download/certificate/{id}', 'download_certificate')->name('download.certificate');
});


