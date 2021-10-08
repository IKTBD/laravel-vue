<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\UserController;

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

Route::any('login',[LoginController::class,'login']);
Route::any('registration',[LoginController::class,'registration']);

Route::middleware('auth2')->group(function(){
    Route::any('logout',[LoginController::class,'logout']);
    Route::any('login_check',[LoginController::class,'login_check']);
    Route::any('user',[UserController::class,'user']);
    Route::any('update',[UserController::class,'update']);
});
