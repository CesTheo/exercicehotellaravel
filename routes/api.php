<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReservationController;
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

// Route Connexion
Route::prefix('/auth')->name('auth.')->group( function () {
    Route::post('/', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'currentUser']);
    Route::middleware('auth:sanctum')->get('/logout', [AuthController::class, 'destroyToken']);

});

// Route Dev
Route::prefix('/dev')->name('dev.')->group( function () {
    Route::get('/', [DevController::class, 'index'])->name('index');
    Route::get('/user', [UserController::class, 'index'])->name('index');
});

// Route Location
Route::prefix('/location')->name('location.')->group( function (){
    Route::middleware('auth:sanctum')->post('/create', [LocationController::class, 'createLocation'])->name('create');
    Route::middleware('auth:sanctum')->get('/delete/{id}', [LocationController::class, 'deleteLocation'])->name('delete');
    Route::get('/', [LocationController::class, 'getAll'])->name('getall');
    Route::get('/get/{id}', [LocationController::class, 'getById'])->name('getbyid');
});


Route::prefix('/reservation')->name('reservation.')->group( function (){
    Route::get('/create', [ReservationController::class, 'create'])->name('create');
    Route::get('/delete', [ReservationController::class, 'delete'])->name('delete');
    Route::get('/get/{id}', [ReservationController::class, 'get'])->name('get');
    Route::get('/getAll/{id}', [ReservationController::class, 'getAll'])->name('getAll');
    // Modifier Réservation
});

Route::prefix('/categorie')->name('categorie.')->group( function (){
    Route::post('/create', [CategorieController::class, 'create'])->name('create');
    Route::post('/add', [CategorieController::class, 'AddToLocation'])->name('add');
    Route::get('/get/{id}', [CategorieController::class, 'getLocationsByCategorie'])->name('getLocationByCategorie');
    Route::post('/gets', [CategorieController::class, 'getLocationsByCategories'])->name('getLocationByCategories');
});