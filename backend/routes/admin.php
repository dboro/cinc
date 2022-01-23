<?php

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


Route::middleware(['auth:sanctum'])->group(function () {

    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)
        ->parameters(['products' => 'id']);

    Route::get('accounts/count', [\App\Http\Controllers\Admin\AccountController::class, 'count']);
    Route::resource('accounts', \App\Http\Controllers\Admin\AccountController::class)
        ->parameters(['accounts' => 'id']);
    Route::get('accounts/{id}/check-user', [\App\Http\Controllers\Admin\AccountController::class, 'checkUser']);
    Route::get('accounts/{id}/users', [\App\Http\Controllers\Admin\AccountController::class, 'users']);
    Route::post('accounts/{id}/users/{user}', [\App\Http\Controllers\Admin\AccountController::class, 'addUser']);
    Route::delete('accounts/{id}/users/{user}', [\App\Http\Controllers\Admin\AccountController::class, 'deleteUser']);
    Route::put('accounts/{id}/users/{user}', [\App\Http\Controllers\Admin\AccountController::class, 'active']);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->parameters(['users' => 'id']);
});

