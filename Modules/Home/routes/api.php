<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\app\Http\Controllers\HomeController;
use Modules\Home\app\Http\Controllers\FilterUserController;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('home_information', [HomeController::class,'homeInformation']);
    Route::post('explore_user', [HomeController::class,'exploreUser']);
    Route::post('filter_user', [FilterUserController::class,'FilterUser']);
});
