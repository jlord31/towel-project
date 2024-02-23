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

Route::view('/admin','login');
Route::view('/admin/login','login');
Route::post('/admin/login',[MainController::class,'login'])->name('login');

Route::get('/admin/logout', function () {
    if (Auth::guard('admin')->check()) {

        // Auth::guard('uni')->user()->update(['is_logged_on' => 0]);

        Auth::guard('admin')->logout();
        return Redirect("/admin/login");
    }
})->name('logout');

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function(){

    Route::get('/dashboard',[MainController::class,'dashboard'])->name('dashboard');

    // country routes
    Route::get('/country',[MainController::class,'countryView'])->name('country');
    Route::post('/country',[MainController::class,'saveNewCountry'])->name('country');
    Route::delete('/delete-country/{id}', [MainController::class,'deleteCountry'])->name('delete-country');
    Route::get('/country/load-country-details/{id}',[MainController::class,'loadCountryDetails'])->name('load-country-details');
    Route::post('/country/update-country',[MainController::class,'updateCountry'])->name('update-country');
    
    // category routes
    Route::get('/category',[MainController::class,'categoryView'])->name('category');
    Route::post('/category',[MainController::class,'saveNewCategory'])->name('category');
    Route::delete('/delete-category/{id}', [MainController::class,'deleteCategory'])->name('delete-category');
    Route::get('/category/load-category-details/{id}',[MainController::class,'loadCategoryDetails'])->name('load-category-details');
    Route::post('/category/update-category',[MainController::class,'updateCategory'])->name('update-category');

    // coupon routes
    Route::get('/coupon',[MainController::class,'couponView'])->name('coupon');
    Route::post('/coupon',[MainController::class,'saveNewCoupon'])->name('coupon');
    Route::delete('/delete-coupon/{id}', [MainController::class,'deleteCoupon'])->name('delete-coupon');
    Route::get('/coupon/load-coupon-details/{id}',[MainController::class,'loadCouponDetails'])->name('load-coupon-details');
    Route::post('/coupon/update-coupon',[MainController::class,'updateCoupon'])->name('update-coupon');

    Route::view('/change-password','change-password');
    Route::get('/change-password',[MainController::class,'changePasswordView'])->name('change-password');
    Route::post('/change-password',[MainController::class,'changePassword'])->name('change-password');

    // Route::view('/settings','admin.settings');
    Route::get('/settings',[AdminUserController::class,'SettingsView'])->name('admin.settings');
    Route::post('/settings',[AdminUserController::class,'Settings'])->name('admin.settings');
    Route::post('/settings/notification-settings',[AdminUserController::class,'notificationSettings'])->name('admin.notification-settings');

    
});