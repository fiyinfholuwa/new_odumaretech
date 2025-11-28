<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleDriveController;


require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';
require __DIR__.'/external.php';

require __DIR__.'/instructor.php';

Route::get('/redirect', [AuthController::class, 'check_login'])->middleware(['auth', 'verified'])->name('redirect');
Route::get('admin/dashboard', [AuthController::class, 'admin_dashboard'])->middleware(['auth', 'verified', 'is_admin'])->name('admin.dashboard');
Route::get('instructor/dashboard', [AuthController::class, 'instructor_dashboard'])->middleware(['auth', 'verified'])->name('instructor.dashboard');
Route::get('external/instructor/dashboard', [AuthController::class, 'external_instructor_dashboard'])->middleware(['auth', 'verified'])->name('external.instructor.dashboard');
Route::get('user/dashboard', [AuthController::class, 'user_dashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');



Route::post('/upload-to-drive', [GoogleDriveController::class, 'upload'])->name('drive.upload');
Route::match(['get', 'post'], '/google-drive', [GoogleDriveController::class, 'index']);


Route::get('/google/drive/auth', [GoogleDriveController::class, 'redirectToGoogle'])->name('google.drive.auth');
Route::get('/google/drive/callback', [GoogleDriveController::class, 'googleCallback'])->name('google.drive.callback');

Route::post('/drive/upload', [GoogleDriveController::class, 'uploadFile'])->name('drive.uploadFile');
Route::post('/drive/delete', [GoogleDriveController::class, 'deleteFile'])->name('drive.deleteFile');
Route::post('/drive/replace', [GoogleDriveController::class, 'replaceFile'])->name('drive.replaceFile');
