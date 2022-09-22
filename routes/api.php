<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
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


Route::prefix('admin')->group(function () {

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('admin_logout', [LoginController::class, 'logout']);
    });
});

Route::prefix('user')->group(function() {
    Route::post('admin_login', [LoginController::class, 'login']);
    Route::middleware('auth:user')->group(function() {
        Route::get('admin_logout', [LoginController::class, 'logout']);
    });
});