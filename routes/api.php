<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\authController;
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
    Route::get('users/mostrarU/', [ApiController::class, 'mostrarUsers']);
    // Route::get('users/mostrarU/{id}',[ApiController::class,'mostrarUser']);
    Route::get('users/mostrarU/id={id}', [ApiController::class, 'mostrarUser']);
    Route::post('users/mostrarU2', [ApiController::class, 'mostrarUser2']);
    Route::post('users/create', [ApiController::class, 'create']);



    Route::post('/sanctum/token', [authController::class, 'generateToken']);
    Route::post('/user/revoke', [authController::class, 'revokeToken']);

    Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        return 'Tokens eliminado';
    });

