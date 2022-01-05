<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Model_character;
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
foreach (File::allFiles('..\App\Routes') as $route_file) {
    require $route_file->getPathname();
}

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
