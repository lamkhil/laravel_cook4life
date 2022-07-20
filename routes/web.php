<?php

use App\Models\Resep;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/share/{id}', function ($id) {
    $data = array();
    $data['resep'] = Resep::find($id);
    if ($data['resep'] == null) {
        return view('error');
    } else {
        return view('share', $data);
    }
});
