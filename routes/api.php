<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleDriveController;

Route::post('/google-drive/upload', [GoogleDriveController::class, 'upload']);
Route::delete('/google-drive/delete/{id}', [GoogleDriveController::class, 'delete']);
Route::get('/google-drive/list', [GoogleDriveController::class, 'list']);

Route::get('/google-drive/auth-url', [GoogleDriveController::class, 'getAuthUrl']);
Route::get('/google-drive/callback', [GoogleDriveController::class, 'callback']);

Route::post('/google-drive/upload', [GoogleDriveController::class, 'upload']);
Route::delete('/google-drive/delete/{id}', [GoogleDriveController::class, 'delete']);
Route::get('/google-drive/list', [GoogleDriveController::class, 'list']);
