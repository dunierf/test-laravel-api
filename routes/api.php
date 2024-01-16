<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Public endpoints
Route::post('auth/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('login');

Route::apiResources([
    'products'     => App\Http\Controllers\ProductController::class
], ['only' => ['index', 'show']]);


// Auth needed
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::delete('auth/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    // Manager
    Route::middleware('role:manager')->group(function () {

        //Get Roles
        Route::apiResources([
            'roles'     => App\Http\Controllers\RoleController::class
        ], ['only' => ['index', 'show']]);

        //Users
        Route::apiResources([
            'users' => App\Http\Controllers\UserController::class
        ]);
    });
});
