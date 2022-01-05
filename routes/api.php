<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PoroController;
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

Route::get('/test', [PoroController::class, 'test']);
Route::get('/test1', function(){
    $users = DB::select('SELECT * from t_character');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});