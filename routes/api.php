<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Model_character;
use App\Http\Controllers\PoroController;
use App\Routes\user;
use App\Http\Controllers\JWTAuthController;
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
require_once app_path() . '\Routes\user.php';

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('unauthorized', function() {
    return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized'
    ], 401);
})->name('api.jwt.unauthorized');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user', [JWTAuthController::class, 'user'])->name('api.jwt.user');
});