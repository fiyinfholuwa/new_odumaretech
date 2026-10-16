<?php

use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

Route::get('/support/login', [SupportController::class, 'login'])
    ->name('support.login');
Route::post('/support/login', [SupportController::class, 'authenticate'])
    ->middleware('throttle:5,1')
    ->name('support.authenticate');

Route::get('/support/dashboard', [SupportController::class, 'dashboard'])
    ->name('support.dashboard');
Route::post('/support/impersonate', [SupportController::class, 'impersonate'])
    ->name('support.impersonate');
Route::post('/support/impersonation/stop', [SupportController::class, 'stopImpersonating'])
    ->middleware('auth')
    ->name('support.impersonation.stop');
Route::post('/support/logout', [SupportController::class, 'logout'])
    ->name('support.logout');
