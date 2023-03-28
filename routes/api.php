<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Rota pública
Route::post('/login', [AuthController::class,'login']);

//Rotas sensíveis
Route::group(['middleware' => ['apiJwt']], function (){
    Route::get('/users', [UserController::class,'index']);
    Route::post('/users', [UserController::class,'store']);
});
