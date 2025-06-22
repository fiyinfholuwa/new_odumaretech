<?php

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::controller(InstructorController::class)->group(function () {
        Route::get('/instructor/slide/view', 'slide_view')->name('slide.view');
        Route::post('/instructor/slide/add', 'slide_add')->name('slide.add');
        Route::get('/instructor/slide/all', 'slide_all')->name('slide.all');
        Route::get('/instructor/slide/edit/{id}', 'slide_edit')->name('slide.edit');
        Route::post('/instructor/slide/delete/{id}', 'slide_delete')->name('slide.delete');
        Route::post('/instructor/slide/update/{id}', 'slide_update')->name('slide.update');
        Route::get('/instructor/assignment/view', 'assignment_view')->name('assignment.view');
        Route::post('/instructor/assigment/add', 'assignment_add')->name('assignment.add');
        Route::get('/instructor/assignment/all', 'assignment_all')->name('assignment.all');
        Route::get('/instructor/assignment/edit/{id}', 'assignment_edit')->name('assignment.edit');
        Route::post('/instructor/assignment/delete/{id}', 'assignment_delete')->name('assignment.delete');
        Route::post('/instructor/assignment/update/{id}', 'assignment_update')->name('assignment.update');
        Route::get('/instructor/session/view', 'session_view')->name('session.view.instructor');
        Route::post('/instructor/session/add', 'session_add')->name('session.add');
        Route::get('/instructor/session/all', 'session_all')->name('session.all.instructor');
        Route::get('/instructor/session/edit/{id}', 'session_edit')->name('session.edit');
        Route::post('/instructor/session/delete/{id}', 'session_delete')->name('session.delete');
        Route::post('/instructor/session/update/{id}', 'session_update')->name('session.update');
        Route::get('/instructor/notification/view', 'notification_view')->name('notification.view_instructor');
        Route::post('/instructor/notification/add', 'notification_add')->name('notification.add');
        Route::get('/instructor/notification/all', 'notification_all')->name('notification.all.instructor');
        Route::get('/instructor/notification/edit/{id}', 'notification_edit')->name('notification.edit');
        Route::post('/instructor/notification/delete/{id}', 'notification_delete')->name('notification.delete');
        Route::post('/instructor/notification/update/{id}', 'notification_update')->name('notification.update');
        Route::get('/instructor/assignment/submitted', 'assess_submitted_assignment')->name('assignment.submitted.review');
        Route::get('/instructor/assignment/review/{id}', 'view_submitted_assignment')->name('assignment.submitted.to');
        Route::post('/instructor/assignment/graded/{id}', 'assignment_instructor_grade')->name('assignment.review.instructor');
        Route::get('/instructor/chat/view', 'instructor_chat_view')->name('instructor.chat.view');
        Route::post('/instructor/chat/add', 'instructor_chat_add')->name('instructor.chat.add');
        Route::get('/instructor/chat/all', 'instructor_chat_all')->name('instructor.chat.all');
        Route::get('/instructor/chat/{id}', 'instructor_chat_reply')->name('instructor.chat.reply');
        Route::get('/instructor/chats/student', 'student_chat_all')->name('student.chat');
        Route::get('/instructor/student/chat/{id}', 'student_user_chat_reply')->name('student.chat.reply');
        Route::post('/instructor/chat/reply/{id}', 'instructor_chat_replied')->name('instructor.chat.replied');
        Route::get('/instructor/student/chat/reply/{id}', 'instructor_student_chat_reply')->name('instructor.student.chat.reply');
        Route::post('/instructor/student/chat/reply/add/{id}', 'instructor_student_chat_reply_add')->name('instructor.student.chat.reply.add');
        Route::get('/instructor/github/', 'instructor_github')->name('instructor.github');
        Route::get('/instructor/meeting/', 'instructor_meeting')->name('instructor.meeting');
        Route::get('/instructor/recording/', 'instructor_record')->name('instructor.record');
        Route::get('/instructor/password/view/', 'instructor_password_view')->name('instructor.password.view');
        Route::post('/instructor/password/change/', 'instructor_password_change')->name('instructor.password.change');
        Route::get('/instructor/project/final', 'project_final_view')->name('project.final.view');
        Route::post('/instructor/project/final/add', 'project_final_add')->name('project.final.add');
        Route::get('/instructor/project/final/all', 'project_final_all')->name('project.final.all');
        Route::post('/instructor/project/delete/{id}', 'project_delete')->name('project.delete');
        Route::get('/instructor/project/final_edit/{id}', 'project_edit_final')->name('project.instructor');
        Route::post('/instructor/project/update/{id}', 'project_update')->name('project.update');
        Route::get('/instructor/project/submitted', 'assess_submitted_project')->name('project.submitted.review');
        Route::get('/instructor/project/review/{id}', 'view_submitted_project')->name('project.submitted.to');
        Route::post('/instructor/project/graded/{id}', 'project_instructor_grade')->name('project.review.instructor');
    });
});    


