<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::prefix('/auth')->name('auth.')->group( function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'currentUser']);
    Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'destroyToken']);

});