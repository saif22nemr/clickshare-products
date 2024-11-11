<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::post('login' , [LoginController::class , 'login']);

Route::group(['middleware' => 'auth:sanctum'] , function(){
    Route::get('profile' , [ProfileController::class ,'profile']);
    Route::apiResource('product' , ProductController::class);
});
