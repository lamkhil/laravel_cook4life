<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TokoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    Route::get('/toko', [TokoController::class, 'index']);
    Route::post('/toko', [TokoController::class, 'store']);
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/resep', [ResepController::class, 'index']);
    Route::post('/resep', [ResepController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

//API without bearer token
//API Authentication
Route::post('/google_sign_in', [UserController::class, 'login']);
