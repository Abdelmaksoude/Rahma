<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthUser\app\Http\Controllers\AuthUserController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthUserController::class,'login']);
    Route::post('logout', [AuthUserController::class,'logout'])->middleware('auth:sanctum');
    Route::post('register_main_info', [AuthUserController::class,'registerMainInfo']);
    Route::post('register_photo', [AuthUserController::class,'registerPhoto'])->middleware('auth:sanctum');
    Route::post('register_kids', [AuthUserController::class,'registerKids'])->middleware('auth:sanctum');
    Route::post('register_user_profile', [AuthUserController::class,'registerUserProfile'])->middleware('auth:sanctum');
    Route::get('list_profile_header_value', [AuthUserController::class,'ListProfileHeaderValue']);
    Route::get('list_explore', [AuthUserController::class,'ListExplore']);
});

