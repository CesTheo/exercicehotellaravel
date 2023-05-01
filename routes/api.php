<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReservationController;
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
    Route::get('/islogin', [AuthController::class, 'isLogin']);
});

// Route Dev
// Route::prefix('/dev')->name('dev.')->group( function () {
//     Route::get('/', [DevController::class, 'index'])->name('dev1');
//     Route::get('/user', [UserController::class, 'index'])->name('dev2');
// });

// Route Location
Route::prefix('/location')->name('location.')->group( function (){
    Route::middleware('auth:sanctum', 'admin')->post('/create', [LocationController::class, 'createLocation'])->name('create'); 
    Route::middleware('auth:sanctum', 'admin')->get('/delete/{id}', [LocationController::class, 'deleteLocation'])->name('delete');
    Route::middleware('auth:sanctum', 'admin')->post('/modify', [LocationController::class, 'modifyLocation'])->name('modification');
    Route::get('/', [LocationController::class, 'getAll'])->name('getall');
    Route::get('/get/{id}', [LocationController::class, 'getById'])->name('getbyid');
});

// Route Reservation
Route::prefix('/reservation')->name('reservation.')->group( function (){
    Route::middleware('auth:sanctum', 'admin')->get('/create', [ReservationController::class, 'create'])->name('create');
    Route::middleware('auth:sanctum', 'admin')->get('/delete', [ReservationController::class, 'delete'])->name('delete');
    Route::get('/get/{id}', [ReservationController::class, 'get'])->name('get');
    Route::get('/getAll/{id}', [ReservationController::class, 'getAll'])->name('getAll');
    // Modifier Réservation
    // Calendrier De Reservation
});


//Route Categorie
Route::prefix('/categorie')->name('categorie.')->group( function (){
    Route::middleware('auth:sanctum', 'admin')->post('/create', [CategorieController::class, 'create'])->name('create');
    Route::middleware('auth:sanctum', 'admin')->get('/delete/{id}', [CategorieController::class, 'delete'])->name('delete');
    Route::middleware('auth:sanctum', 'admin')->post('/add', [CategorieController::class, 'AddToLocation'])->name('add');
    Route::middleware('auth:sanctum', 'admin')->get('/reset/{id}', [CategorieController::class, 'resetCategorieToLocation'])->name('resetCategorieToLocation');
    Route::get('/get/{id}', [CategorieController::class, 'getLocationsByCategorie'])->name('getLocationByCategorie');
    Route::post('/gets', [CategorieController::class, 'getLocationsByCategories'])->name('getLocationByCategories');
    Route::get('/all', [CategorieController::class, 'getAllCategories'])->name('getAllCategories');
});