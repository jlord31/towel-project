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

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function()
{
    // protected user group route
    Route::group(['prefix' => '/user'], function()
    {

        Route::get('profile',[UserController::class,'profile']);
        Route::get('logout',[UserController::class,'logout']);
        Route::post('update-user',[UserController::class,'updateProfile']);
        Route::post('change-password',[UserController::class,'changePassword']);
        Route::post('report',[UserController::class,'userReport']);

        //protected wishlist route
        Route::group(['middleware' => 'auth:api', 'prefix' => '/wishlist'], function()
        {
            Route::get('/',[UserController::class,'getWishList']);
        
            Route::post('add',[UserController::class,'addWishList']);

            Route::delete('delete/{id}',[UserController::class,'deleteWishList']);
        });

        //protected ride route
        Route::group(['middleware' => 'auth:api', 'prefix' => '/ride'], function()
        {
            Route::get('/',[UserController::class,'getRide']);
        
            Route::post('add',[UserController::class,'addRide']);
        });
        
    });

    //protected property route
    Route::group(['middleware' => 'auth:api', 'prefix' => '/property'], function()
    {

        Route::get('/',[MainController::class,'property']);
    
        Route::get('category',[MainController::class,'getCategory']);

        Route::post('add-booking',[UserController::class,'addBooking']);

        Route::get('get-nearby-properties',[MainController::class,'getNearbyProperty']);
    });

    Route::get('get-available-payment-method',[MainController::class,'getPaymentMethod']);
    
});

