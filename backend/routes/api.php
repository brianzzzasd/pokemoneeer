<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', [UserController::class, 'user']);
    });

    Route::group(['prefix' => 'pokemon'], function() {
        Route::get('/', [PokemonController::class, 'pokemon']);
        Route::post('favorite', [PokemonController::class, 'addFavorite']);
        Route::post('hate', [PokemonController::class, 'addHate']);
        Route::post('like', [PokemonController::class, 'addLike']);

        Route::delete('favorite/{id}', [PokemonController::class, 'deleteFavorite']);
        Route::delete('hate/{id}', [PokemonController::class, 'deleteHate']);
        Route::delete('like/{id}', [PokemonController::class, 'deleteLike']);
    });
});
