<?php

use App\Http\Controllers\ResepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Komentar;

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

//API with authorization bearer token
Route::middleware('auth:sanctum')->group(function(){

    Route::get('/toko', [ResepController::class, 'toko']);
    Route::post('/toko', [ResepController::class, 'storetoko']);
    
    Route::post('/komentar', [ResepController::class, 'komentar']);
    Route::delete('/komentar/{id}', [ResepController::class, 'komentar']);

    Route::get('/kategori', [ResepController::class, 'kategori']);

    Route::get('/resep', [ResepController::class, 'index']);
    Route::post('/like', [ResepController::class, 'like']);
    Route::post('/favorite', [ResepController::class, 'favorite']);
    Route::post('/resep', [ResepController::class, 'store']);
    Route::post('/rating', [ResepController::class, 'rating']);
    Route::get('/resep/{id}', [ResepController::class, 'show']);

    
    Route::get('/testing', [ResepController::class, 'testing']);

    
    Route::get('/notifikasi', [ResepController::class, 'notifikasi']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/fcm', [UserController::class, 'fcm']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

//API without bearer token
//API Authentication
Route::post('/google_sign_in', [UserController::class, 'login']);

