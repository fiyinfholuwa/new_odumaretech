<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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
    Route::get('/user/profile/view/', 'user_password_view')->name('user.password.view');
    Route::post('/user/password/change/', 'user_password_change')->name('user.password.change');
    Route::get('/user/transactions/all', 'transactions_user')->name('transaction.user.all');

    Route::get('/user/project/view', 'project_view_user')->name('project.user.view');
    // Route::get('/user/assignment/all/{id}', 'assignment_user_all')->name('assignment.user.all');
    Route::get('/user/project/submit/{id}/{co}', 'project_submit')->name('project.submit');
    Route::post('/user/project/submit/save/{id}', 'project_submit_user')->name('project.submit.user');
    Route::get('/user/project/submitted', 'project_submitted')->name('project.submitted.user');
    Route::get('/user/download/certificate/{id}', 'download_certificate')->name('download.certificate');
    Route::get('/user/reward', 'user_reward')->name('user.reward');
    Route::get('/user/badge', 'user_badge')->name('user.badge');
    Route::get('/user/leaderboard', 'user_leaderboard')->name('user.leaderboard');
    Route::get('/user/certificates', 'user_certificates')->name('user.certificates');
    Route::get('/user/payout', 'myPayoutRequests')->name('user.payout');
    Route::get('/user/view/curriculum/{id}', 'user_view_course_curriculum')->name('user.view.course.curriculum');
    Route::post('/user/profile/update', 'updateProfile')->name('user.profile.update');
    Route::post('/user/bankinfo/update', 'updateBankInfo')->name('user.bankinfo.update');

    Route::post('/user/payout/request','requestPayout')
        ->name('user.payout.request');
    





});

Route::middleware(['auth'])->controller(PaymentController::class)->group(function () {
    Route::post('/pay', 'makePayment')->name('pay');
    Route::get('/payment/callback/paystack', 'paymentCallbackPaystack')->name('pay.callback.paystack');
    Route::get('/payment/callback/stripe/success', 'paymentcallbackstripesuccess')->name('pay.callback.stripe.success');
    Route::get('/payment/callback/stripe/cancel', 'paymentCallbackStripeFailed')->name('pay.callback.stripe.failed');
    Route::get('user/paypal/success', 'paypal_success')->name('paypal.success');

    Route::get('/payment/flutterwave/success', 'flutterwaveSuccess')->name('flutterwave.success');
    Route::get('/payment/complete/flutterwave/success', 'flutterwaveCompleteSuccess')->name('flutterwave.complete.success');
    Route::get('/payment/flutterwave/failed','flutterwaveFailed')->name('flutterwave.failed');

        Route::get('user/paypal/failed', 'paypal_failed')->name('paypal.failed');

    Route::get('/payment/callback/stripe/success/complete', 'user_complete_callback_stripe_complete')->name('pay.callback.stripe.success.complete');

    Route::get('/admin/transactions/all', 'transactions')->name('transaction.all');
    Route::post('/admin/fix/payment/{id}', 'admin_fix_payment')->name('admin.fix.payment');
    Route::get('/user/transactions/all', 'transactions_user')->name('transaction.user.all');
    Route::post('/payment/conplete/{id}', 'user_complete')->name('user.complete.payment');
    Route::post('/payment/resolution/{id}', 'payment_resolution')->name('payment.resolution');
    Route::get('/payment/callback/user', 'user_complete_callback')->name('pay.callback.user.complete');
});
Route::middleware(['auth'])->controller(CommunityController::class)->group(function () {
    Route::get('/forum', 'forum')->name('forum');
    Route::post('/threads', 'store')->name('threads.store');
    Route::post('/delete/threads/{id}',  'destroy')->name('threads.destroy');

    Route::get('/threads/{id}', 'show')->name('threads.show');
    Route::post('/threads/{id}/reply','reply')->name('threads.reply');
    Route::post('/replies/{id}/helpful','markHelpful')->name('replies.helpful');


    Route::get('/q&a', 'q_a')->name('q.a');
    Route::post('/add/questions', 'storeQuestion')->name('question.store');
    Route::post('/delete/threads/{id}',  'destroy')->name('threads.destroy');
    Route::post('/question/solved/{id}',  'question_solved')->name('question.solved');

    Route::get('/question/{id}', 'q_a_detail')->name('question.show');
    Route::post('/question/{id}/reply','q_a_reply')->name('question.reply');
    Route::post('/question/replies/{id}/helpful','QuestionmarkHelpful')->name('question.replies.helpful');
});


Route::middleware('auth')->group(function () {
    
});

