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

    Route::get('dashboard',[MainController::class,'dashboard'])->name('dashboard');

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

    // facility routes
    Route::get('/facility',[MainController::class,'facilityView'])->name('facility');
    Route::post('/facility',[MainController::class,'saveNewFacility'])->name('facility');
    Route::delete('/delete-facility/{id}', [MainController::class,'deleteFacility'])->name('delete-facility');
    Route::get('/facility/load-facility-details/{id}',[MainController::class,'loadFacilityDetails'])->name('load-facility-details');
    Route::post('/facility/update-facility',[MainController::class,'updateFacility'])->name('update-facility');

    // coupon routes
    Route::get('/coupon',[MainController::class,'couponView'])->name('coupon');
    Route::post('/coupon',[MainController::class,'saveNewCoupon'])->name('coupon');
    Route::delete('/delete-coupon/{id}', [MainController::class,'deleteCoupon'])->name('delete-coupon');
    Route::get('/coupon/load-coupon-details/{id}',[MainController::class,'loadCouponDetails'])->name('load-coupon-details');
    Route::post('/coupon/update-coupon',[MainController::class,'updateCoupon'])->name('update-coupon');

    // payment management routes
    Route::get('/payment',[MainController::class,'paymentView'])->name('payment');
    Route::post('/payment/update-status/{id}',[MainController::class,'updateMobilePaymentStatus'])->name('update-mobile-payment-status');
    Route::delete('/delete-payment/{id}', [MainController::class,'deletePayment'])->name('delete-payment');
    Route::get('/coupon/load-payment-details/{id}',[MainController::class,'loadPaymentDetails'])->name('load-payment-details');
    Route::post('/coupon/update-payment',[MainController::class,'updatePayment'])->name('update-payment');

    // user list management routes
    Route::get('/user-list',[MainController::class,'userListView'])->name('user-list');
    Route::post('/user/update-status/{id}',[MainController::class,'updateUserStatus'])->name('update-user-status');

    // enquiries route
    //Route::get('/enquiries',[MainController::class,'enquiriesView'])->name('enquiries');
    Route::view('/enquiries','enquiries')->name('enquiries');

    // reports route
    Route::get('/reports',[MainController::class,'reportsView'])->name('reports');
    Route::post('/reports/update-report-status/{id}',[MainController::class,'updateReportStatus'])->name('update-report-status');
    
    //Route::view('/reports','enquiries')->name('reports');
    
    
    // booking route
    //Route::get('/booking',[MainController::class,'bookingView'])->name('booking');
    Route::view('/booking','booking')->name('booking');

    // payout-list route
    //Route::get('/payout-list',[MainController::class,'payoutListView'])->name('payout-list');
    Route::view('/payout-list','payout-list')->name('payout-list');

    // property route
    //Route::get('/property',[MainController::class,'propertyView'])->name('property');
    Route::view('/property','property')->name('property');
    

    // admin settings route
    Route::get('/settings',[MainController::class,'SettingsView'])->name('settings');
    Route::post('/settings',[MainController::class,'Settings'])->name('settings');

    //Route::view('/change-password','change-password');
    //Route::get('/change-password',[MainController::class,'changePasswordView'])->name('change-password');
    Route::post('/settings/change-password',[MainController::class,'changePassword'])->name('change-password');
    
    
});