<?php
namespace App\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PoroController;

Route::get('/character', [PoroController::class, 'index_get']);

Route::get('/character/list', [PoroController::class, 'list_get']);

Route::get('/character/search', [PoroController::class, 'search_get']);


