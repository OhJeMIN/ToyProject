<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Model_character;
use App\Http\Controllers\PoroController;
use App\Routes\user;

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
