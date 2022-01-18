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
// foreach (File::allFiles('../app/Routes') as $route_file) {
//      $route_file->getPathname();
// }
//require '../app/Routes/character.php';
Route::get('/character', [PoroController::class, 'index_get']);

Route::get('/character/list', [PoroController::class, 'list_get']);

Route::get('/character/search', [PoroController::class, 'search_get']);

Route::get('/character/all', [PoroController::class, 'all_get']);

Route::get('/character/item', [PoroController::class, 'all_item']);

Route::get('/character/champion_skill', [PoroController::class, 'champ_skill']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
