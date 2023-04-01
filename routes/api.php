<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeIngredientController;

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

//Public
Route::post('/login', [AuthController::class,'login']);

//Private
Route::group(['middleware' => ['apiJwt']], function (){
    //Users
    Route::get('/users', [UserController::class,'index']);
    Route::post('/user', [UserController::class,'store']);

    //Ingredients
    Route::get('/ingredients', [IngredientController::class,'index']);
    Route::get('/ingredient/{id}', [IngredientController::class,'show']);
    Route::post('/ingredient', [IngredientController::class,'store']);
    Route::put('/ingredient/{id}', [IngredientController::class,'update']);
    Route::delete('/ingredient/{id}', [IngredientController::class,'destroy']);

    //Recipes
    Route::get('/recipes', [RecipeController::class,'index']);
    Route::get('/recipe/{id}', [RecipeController::class,'show']);
    Route::post('/recipe', [RecipeController::class,'store']);
    Route::put('/recipe/{id}', [RecipeController::class,'update']);
    Route::delete('/recipe/{id}', [RecipeController::class,'destroy']);

    //Recipes Ingredients
    Route::post('/recipeIngredients/{id}', [RecipeIngredientController::class,'show']);
    Route::post('/recipeIngredient/{id}', [RecipeIngredientController::class,'store']);

    //Dash
    Route::get('/recipeIngredients/dashboard', [RecipeIngredientController::class,'dashBoard']);

});
