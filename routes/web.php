<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function(){

    // Route::view('/dashboard','admin.dashboard')->name('admin.dashboard');
    Route::get('/dashboard',[MainController::class,'dashboard'])->name('dashboard');

    Route::view('/change-password','admin.change-password');
    Route::get('/change-password',[AdminUserController::class,'changePasswordView'])->name('admin.change-password');
    Route::post('/change-password',[AdminUserController::class,'changePassword'])->name('admin.change-password');

    // Route::view('/settings','admin.settings');
    Route::get('/settings',[AdminUserController::class,'SettingsView'])->name('admin.settings');
    Route::post('/settings',[AdminUserController::class,'Settings'])->name('admin.settings');
    Route::post('/settings/notification-settings',[AdminUserController::class,'notificationSettings'])->name('admin.notification-settings');

    
});