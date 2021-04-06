<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
    Route::get('products', 'ProductsController@list');
    Route::get('product/{product}', 'ProductsController@fetchByVendorId');
    Route::get('vendors', 'VendorController@getAllVendors');
    Route::get('vendor/{id?}', 'VendorController@getVendorService');
    Route::get('getorders/{id?}', 'OrderController@getOrder');
    Route::get('deliveryoption','DeliveryController@deliveryOption');
    Route::get('orderDetail/{id?}','OrderController@orderDetail');
    Route::get('userOrders/{id}','OrderController@userBuyProduct');
    Route::get('pickedupOrders/{id}','OrderController@pickupOrdes');
    Route::get('ordervarinte/{id}','OrderController@ordervarinte');
    Route::group(['prefix' => 'cart'], function(){
        Route::post('/', 'CartController@store');
    });
    Route::post('checkout', 'PaymentController@checkout');
    Route::get('userlocation/{id}', 'UserController@getLocations');
    Route::post('userlocationstore/{id}', 'UserController@store');
    Route::post('userlocationupdate/{id}', 'UserController@update');
    Route::post('userprofileupdate/{id}', 'UserController@userProfileUpdate');
    Route::post('orderStatus','OrderController@orderstatus');

    Route::get('cardList/{id}', 'CardController@cardlist');
    Route::post('cardStore/{id}', 'CardController@cardStore');
    Route::post('cardUpdate/{id}', 'CardController@cardUpdate');
    Route::get('cardDelete/{id}', 'CardController@cardDelete');

    Route::get('vendorCategory', 'VendorCategoryController@categories');
    Route::get('vendorCategory/{id}', 'VendorCategoryController@vendorBycategory');
    Route::get('banners', 'BannerController@index');
    Route::get('ordersubscribe/{id}', 'OrderController@subscribeRecord');
});
