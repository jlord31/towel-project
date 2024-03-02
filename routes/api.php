<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\MainController;


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
//http://localhost:8000/admin/user-list

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//localhost:8000/api/v1/user/auth/register
Route::group(['prefix' => 'v1/user/auth'], function(){
    Route::post('register',[UserController::class,'register']);
    Route::post('login',[UserController::class,'login']);
});

// protected routes
Route::group(['middleware' => 'auth:api', 'prefix' => 'v1/user'], function(){

    Route::get('profile',[UserController::class,'profile']);
    Route::get('logout',[UserController::class,'logout']);
    Route::post('profile',[UserController::class,'updateProfile']);
    
});