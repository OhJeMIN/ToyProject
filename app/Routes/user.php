<?php
namespace App\Routes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JWTAuthController;

Route::post('/register', [JWTAuthController::class, 'register_post']);

