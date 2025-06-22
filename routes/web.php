<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';
require __DIR__.'/frontend.php';
require __DIR__.'/admin.php';
require __DIR__.'/user.php';

require __DIR__.'/instructor.php';

Route::get('/redirect', [AuthController::class, 'check_login'])->middleware(['auth', 'verified'])->name('redirect');
Route::get('admin/dashboard', [AuthController::class, 'admin_dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('instructor/dashboard', [AuthController::class, 'instructor_dashboard'])->middleware(['auth', 'verified'])->name('instructor.dashboard');
Route::get('user/dashboard', [AuthController::class, 'user_dashboard'])->middleware(['auth', 'verified'])->name('user.dashboard');
