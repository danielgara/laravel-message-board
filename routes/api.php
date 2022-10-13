<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Threads\ThreadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Auth routes */
Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('/create', [AuthController::class, 'create'])->name('api.v1.auth.create');
    Route::post('/login', [AuthController::class, 'login'])->name('api.v1.auth.login');
});

/* Auth routes with authentication */
Route::group(['prefix' => 'v1/auth', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/{userId}', [AuthController::class, 'getUser'])->where('userId', '[0-9]+')->name('api.v1.auth.getUser');
});

/* Thread routes with authentication */
Route::group(['prefix' => 'v1/threads', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/', [ThreadController::class, 'create'])->name('api.v1.threads.create');
});
