<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InnovationController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'is_admin'])->controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', 'admin_dashboard')->name('admin.dashboard');
    Route::get('/admin/testimonial/view', 'testimonial_view')->name('testimonial.view');
    Route::get('/admin/testimonial/all', 'testimonial_all')->name('testimonial.all');
    Route::post('/admin/testimonial/add', 'testimonial_add')->name('testimonial.add');
    Route::post('/admin/testimonial/delete/{id}', 'testimonial_delete')->name('testimonial.delete');
    Route::get('/admin/testimonial/edit/{id}', 'testimonial_edit')->name('testimonial.edit');
    Route::post('/admin/testimonial/update/{id}', 'testimonial_update')->name('testimonial.update');
    Route::get('/applicant/resume/{id}', 'viewResume')->name('applicant.view.resume');

    Route::get('/company/training', 'company_view')->name('corporate.training');
    Route::get('/company/training/detail/{id}', 'company_view_detail')->name('corporate.training.detail');
    Route::post('/company/training/add', 'company_add')->name('corporate.training.add');
    Route::get('/company/training/all', 'company_all')->name('company.all');

    Route::get('/instructor', 'instructor_view')->name('instructor');
    Route::get('/admin/intructor/applications', 'instructor_application_all')->name('instructor.application.all');
    Route::post('/admin/intructor/applicant/delete/{id}', 'applicant_delete')->name('applicant.delete');
    Route::get('/admin/intructor/applicant/edit/{id}', 'applicant_edit')->name('applicant.edit');
    Route::post('/admin/intructor/applicant/update/{id}', 'applicant_update')->name('applicant.update');

    Route::get('/admin/chat/all', 'admin_chat_all')->name('admin.chat.all');
    Route::get('/admin/chat/{id}', 'admin_chat_reply')->name('admin.chat.reply');
    Route::post('/admin/chat/reply/{id}', 'admin_chat_replied')->name('admin.chat.replied');

    Route::get('/admin/innovation/view', 'innovation_view')->name('innovation.view');
    Route::get('/admin/innovation/all', 'innovation_all')->name('innovation.all');
    Route::post('/admin/innovation/add', 'innovation_add')->name('innovation.add');
    Route::post('/admin/innovation/delete/{id}', 'innovation_delete')->name('innovation.delete');
    Route::get('/admin/innovation/edit/{id}', 'innovation_edit')->name('innovation.edit');
    Route::post('/admin/innovation/update/{id}', 'innovation_update')->name('innovation.update');

    Route::get('/admin/blog/view', 'blog_view')->name('blog.view');
    Route::get('/admin/blog/all', 'blog_all')->name('blog.all');
    Route::post('/admin/blog/add', 'blog_add')->name('blog.add');
    Route::post('/admin/blog/delete/{id}', 'blog_delete')->name('blog.delete');
    Route::get('/admin/blog/edit/{id}', 'blog_edit')->name('blog.edit');
    Route::post('/admin/blog/update/{id}', 'blog_update')->name('blog.update');

    Route::get('/admin/password/view/', 'admin_password_view')->name('admin.password.view');
    Route::post('/admin/password/change/', 'admin_password_change')->name('admin.password.change');
    Route::post('/admin/user/lock/{id}', 'user_lock')->name('user.lock');
    Route::post('/admin/user/lock/lock/{id}', 'user_lock_lock')->name('user.lock.lock');

    Route::get('/admin/applied/user/view', 'applied_view')->name('applied.view');
    Route::get('/admin/user/view', 'admin_user_view')->name('admin.user.view');
    Route::post('/admin/user/add', 'admin_user_add')->name('admin.user.add');
    Route::post('/admin/applied/user/update/{id}', 'applied_users_update')->name('applied.user.update');
    Route::post('/admin/dollar/save/', 'dollar_save')->name('dollar.save');

    Route::get('/admin/platform/configure', 'platform_configure')->name('platform.configure');
    Route::post('/admin/platform/message/delete', 'platform_message_delete')->name('platform.message.delete');
    Route::post('/admin/platform/corporate/delete', 'platform_corporate_delete')->name('platform.corporate.delete');
    Route::post('/admin/platform/masterclass/delete', 'platform_masterclass_delete')->name('platform.masterclass.delete');

    Route::get('admin/role/view', 'role_view')->name('role.view');
    Route::get('admin/role/edit/{id}', 'role_edit')->name('role.edit');
    Route::post('admin/role/update/{id}', 'role_update')->name('role.update');
    Route::post('admin/role/add', 'role_add')->name('role.add');
    Route::get('admin/role/permission/view/{id}', 'role_permission')->name('role.permission');
    Route::post('admin/role/permission/set/{id}', 'role_permission_set')->name('role.permission.set');
    Route::post('admin/role/delete/{id}', 'role_delete')->name('role.delete');

    Route::get('admin/admin_manager/view', 'admin_manager_view')->name('admin_manager.view');
    Route::post('admin/admin_manager/save', 'admin_admin_manager_save')->name('admin.admin_manager.save');
    Route::get('admin/admin_manager/all', 'admin_manager_all')->name('admin_manager.all');
    Route::get('admin/admin_manager/edit/{id}', 'admin_manager_edit')->name('admin_manager.edit');
    Route::post('admin/admin_manager/update/{id}', 'admin_manager_update')->name('admin.admin_manager.update');
    Route::post('admin/admin_manager/delete/{id}', 'admin_admin_manager_delete')->name('admin.admin_manager.delete');
    Route::post('admin/admin_manager/block/{id}', 'admin_admin_manager_block')->name('admin.admin_manager.block');
});




Route::middleware(['auth', 'is_admin'])->controller(CourseController::class)->group(function () {
    Route::get('/admin/category/manage', 'category_view')->name('category.view');
    Route::post('/admin/category/add', 'category_add')->name('category.add');
    Route::post('/admin/category/delete/{id}', 'category_delete')->name('category.delete');
    Route::get('/admin/category/edit/{id}', 'category_edit')->name('category.edit');
    Route::post('/admin/category/update/{id}', 'category_update')->name('category.update');

    Route::get('/admin/cohort/manage', 'cohort_view')->name('cohort.view');
    Route::post('/admin/cohort/add', 'cohort_add')->name('cohort.add');
    Route::post('/admin/cohort/delete/{id}', 'cohort_delete')->name('cohort.delete');
    Route::get('/admin/cohort/edit/{id}', 'cohort_edit')->name('cohort.edit');
    Route::post('/admin/cohort/update/{id}', 'cohort_update')->name('cohort.update');


    Route::get('/admin/cohort/course', 'cohort_m_view')->name('cohort_m.view');
    Route::post('/admin/cohort/course/add', 'cohort_m_add')->name('cohort_m.add');
    Route::post('/admin/cohort/course/delete/{id}', 'cohort_m_delete')->name('cohort_m.delete');
    Route::get('/admin/cohort/course/edit/{id}', 'cohort_m_edit')->name('cohort_m.edit');
    Route::post('/admin/cohort/course/update/{id}', 'cohort_m_update')->name('cohort_m.update');



    Route::get('/admin/course/view', 'course_view')->name('course.view');
    Route::get('/admin/course/all', 'course_all')->name('course.all');
    Route::post('/admin/course/add', 'course_add')->name('course.add');
    Route::post('/admin/course/delete/{id}', 'course_delete')->name('course.delete');
    Route::get('/admin/course/edit/{id}', 'course_edit')->name('course.edit');
    Route::post('/admin/course/update/{id}', 'course_update')->name('course.update');

    Route::get('/course/curriculum/{id}',  'curriculum')->name('course.curriculum');
    Route::post('/course/assign-instructor',  'assignInstructor')->name('course.assignInstructor');

    Route::post('/admin/course/{id}/save-curriculum',  'saveCurriculum')->name('course.saveCurriculum');


//    Route::get('/course/{name}', 'course_detail')->name('course.detail');
    Route::get('/course/category/{name}', 'course_category')->name('course.category');
    Route::get('/search', 'search')->name('search');
    Route::get('/admin/coupon/manage', 'coupon_view')->name('coupon.view');
    Route::post('/admin/coupon/add', 'coupon_add')->name('coupon.add');
    Route::post('/admin/coupon/delete/{id}', 'coupon_delete')->name('coupon.delete');
    Route::get('/admin/coupon/edit/{id}', 'coupon_edit')->name('coupon.edit');
    Route::post('/admin/coupon/update/{id}', 'coupon_update')->name('coupon.update');
    Route::post('/coupon/validate', 'coupon_validate')->name('coupon.validate');
});


Route::middleware(['auth', 'is_admin'])->controller(MasterClassController::class)->group(function () {
    Route::get('/masterclass', 'masterclass')->name('masterclass');
    Route::get('/admin/masterclass/link', 'masterclass_link')->name('masterclass.link');
    Route::get('/admin/github/link', 'github_link')->name('github.link');
    Route::post('/admin/github/link/add', 'github_link_add')->name('github.link.add');
    Route::post('/admin/masterclass/link/add', 'masterclass_link_add')->name('masterclass.link.add');
    Route::post('/masterclass/save', 'masterclass_add')->name('masterclass.add');

    Route::post('/masterclass/update/{id}', 'masterclass_manage')->name('masterclass.manage');

    Route::get('/admin/masterclass/all', 'masterclass_all')->name('masterclass.all');
    Route::get('/admin/meeting/link', 'meeting_link')->name('meeting.link');
    Route::post('/admin/meeting/link/add', 'meeting_link_add')->name('meeting.link.add');

    Route::post('/admin/meeting/link/delete/{id}', 'meeting_link_delete')->name('meeting.link.delete');
    Route::get('/admin/meeting/link/edit/{id}', 'meeting_link_edit')->name('meeting.link.edit');
    Route::post('/admin/meeting/link/update/{id}', 'meeting_link_update')->name('meeting.link.update');

    Route::get('/admin/record/link', 'record_link')->name('record.link');
    Route::post('/admin/record/link/delete/{id}', 'record_link_delete')->name('record.link.delete');
    Route::get('/admin/record/link/edit/{id}', 'record_link_edit')->name('record.link.edit');
    Route::post('/admin/record/link/update/{id}', 'record_link_update')->name('record.link.update');
    Route::post('/admin/record/link/add', 'record_link_add')->name('record.link.add');
    // Route::post('/admin/contact/delete/{id}', 'message_delete')->name('contact.delete');
});



Route::middleware(['auth', 'is_admin'])->controller(InnovationController::class)->group(function () {
    Route::get('/innovation/detail/{id}', 'innovation_detail')->name('innovation.detail');
    Route::post('/innovation/add/', 'innovation_add')->name('innovation.apply');
    Route::get('/innovation/apply/view', 'innovation_apply_view')->name('innovation.apply.view');
    Route::post('/innovation/delete/{id}', 'innovation_delete')->name('inno.delete');
});



Route::middleware(['auth', 'is_admin'])->controller(ContactController::class)->group(function () {
    Route::post('/contact/save', 'contact_save')->name('contact.save');
    Route::get('/admin/contact/all', 'get_all_message')->name('contact.all');
    Route::post('/admin/contact/delete/{id}', 'message_delete')->name('contact.delete');
});

Route::controller(MasterClassController::class)->group(function () {
    Route::get('/masterclass', 'masterclass')->name('masterclass');
    Route::get('/admin/masterclass/link', 'masterclass_link')->name('masterclass.link');
    Route::get('/admin/github/link', 'github_link')->name('github.link');
    Route::post('/admin/github/link/add', 'github_link_add')->name('github.link.add');
    Route::post('/admin/masterclass/link/add', 'masterclass_link_add')->name('masterclass.link.add');
    Route::post('/masterclass/save', 'masterclass_add')->name('masterclass.add');

    Route::post('/masterclass/update/{id}', 'masterclass_manage')->name('masterclass.manage');

    Route::get('/admin/masterclass/all', 'masterclass_all')->name('masterclass.all');
    Route::get('/admin/meeting/link', 'meeting_link')->name('meeting.link');
    Route::post('/admin/meeting/link/add', 'meeting_link_add')->name('meeting.link.add');

    Route::post('/admin/meeting/link/delete/{id}', 'meeting_link_delete')->name('meeting.link.delete');
    Route::get('/admin/meeting/link/edit/{id}', 'meeting_link_edit')->name('meeting.link.edit');
    Route::post('/admin/meeting/link/update/{id}', 'meeting_link_update')->name('meeting.link.update');

    Route::get('/admin/record/link', 'record_link')->name('record.link');
    Route::post('/admin/record/link/delete/{id}', 'record_link_delete')->name('record.link.delete');
    Route::get('/admin/record/link/edit/{id}', 'record_link_edit')->name('record.link.edit');
    Route::post('/admin/record/link/update/{id}', 'record_link_update')->name('record.link.update');
    Route::post('/admin/record/link/add', 'record_link_add')->name('record.link.add');
    // Route::post('/admin/contact/delete/{id}', 'message_delete')->name('contact.delete');
});

Route::middleware(['auth', 'is_admin'])->controller(PaymentController::class)->group(function () {
    Route::post('/pay', 'makePayment')->name('pay');
    Route::get('/payment/callback/paystack', 'paymentCallbackPaystack')->name('pay.callback.paystack');
    Route::get('/payment/callback/stripe/success', 'paymentcallbackstripesuccess')->name('pay.callback.stripe.success');
    Route::get('/payment/callback/stripe/cancel', 'paymentCallbackStripeFailed')->name('pay.callback.stripe.failed');

    Route::get('/payment/callback/stripe/success/complete', 'user_complete_callback_stripe_complete')->name('pay.callback.stripe.success.complete');

    Route::get('/admin/transactions/all', 'transactions')->name('transaction.all');
    Route::post('/admin/fix/payment/{id}', 'admin_fix_payment')->name('admin.fix.payment');
    Route::get('/user/transactions/all', 'transactions_user')->name('transaction.user.all');
    Route::post('/payment/conplete/{id}', 'user_complete')->name('user.complete.payment');
    Route::post('/payment/resolution/{id}', 'payment_resolution')->name('payment.resolution');
    Route::get('/payment/callback/user', 'user_complete_callback')->name('pay.callback.user.complete');
});



Route::middleware(['auth', 'is_admin'])->controller(ExportController::class)->group(function () {
    Route::post('/export/users', 'export_users')->name('users.export');
    Route::post('/export/instructors', 'export_instructor')->name('instructors.export');
    Route::post('/export/masterclass', 'export_masterclass')->name('masterclass.export');
    Route::post('/export/company/training', 'export_company_training')->name('company.export');
    Route::post('/export/innovation/application', 'innovation_export')->name('innovation.export');
});

