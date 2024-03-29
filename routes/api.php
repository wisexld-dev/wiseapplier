<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScriptController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/run-script', [ScriptController::class], 'runScript');

Route::prefix('job-applications')->group(function () {
    Route::post('/', [JobApplicationController::class, 'store']);
    Route::get('/', [JobApplicationController::class, 'index']);
    Route::get('/{id}', [JobApplicationController::class, 'show']);
    Route::put('/{id}', [JobApplicationController::class, 'update']);
    Route::delete('/{id}', [JobApplicationController::class, 'destroy']);
});

Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::group(['middleware' => 'jwt.verify'], function() {
    Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
});
