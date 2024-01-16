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

// ----- Public endpoints -----

// Login
Route::post('auth/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('login');

// Get Products
Route::apiResources([
    'products'     => App\Http\Controllers\ProductController::class
], ['only' => ['index', 'show']]);


// ----- Auth needed -----
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::delete('auth/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    // Authed user's roles
    Route::get('auth/roles', [App\Http\Controllers\AuthController::class, 'roles']);

    // Enpoint for manager
    Route::middleware('role:manager')->group(function () {

        // Get Roles, Users
        Route::apiResources([
            'roles'     => App\Http\Controllers\RoleController::class,
            'users' => App\Http\Controllers\UserController::class
        ], ['only' => ['index', 'show']]);

        // POST, PUT users
        Route::middleware('user')->group(function () {
            Route::apiResources([
                'users' => App\Http\Controllers\UserController::class
            ], ['only' => ['store', 'update']]);
        });

        // Delete a user
        Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);

        /*
        // Products
        Route::apiResources([
            'products'     => App\Http\Controllers\ProductController::class
        ], ['only' => ['store', 'update']]);*/
    });
});
