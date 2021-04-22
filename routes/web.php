<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::post('getRows','ServiceController@index')->name('get_rows');
// Route::get('premium','PaymentController@premiumCustomer')->name('premium')->middleware('auth');
Route::get('premium','PaymentController@premiumCustomer')->name('premium');
Route::get('premiumstatus','PaymentController@basicUser')->name('premiumstatus');
Route::post('premiumuser','PaymentController@premiumUser')->name('premiumuser');
Route::post('emailrequest','SiteController@emailVerification')->name('emailrequest');
Route::middleware(['premium.customer'])->group(function(){

	Route::get('/', 'SiteController@index')->name('site');
	Route::resource('site', 'SiteController');
	Route::get('get-prod-varients/{id?}', 'SiteController@fetchByProductId')->name('get-prod-varients');
	Route::get('add-to-cart', 'SiteController@addToCart')->name('add-to-cart');
	Route::get('product-data/{id?}', 'SiteController@getProductDataById')->name('product.data');
	Route::get('variant-data/{id?}', 'SiteController@getVariantDataById')->name('variant.data');
	Route::resource('cart', 'CartController');
	Route::get('update-quantity','CartController@updateCartQuantity')->name('update-quantity');
	Route::get('cart-checkout', 'CartController@checkout')->name('site.checkout');
	Route::get('cart-destroy', 'CartController@destroy')->name('site.checkout');
	Route::post('/explore-shop', 'SiteController@nearShops')->name('site.explore.shop');
	Route::get('/explore-shops', 'SiteController@allShops')->name('site.explore.shops');
	Route::get('profile', 'SiteController@profile')->name('profile');
	Route::put('profileEdit/{id}', 'SiteController@profileEdit')->name('profileEdit');
	Route::get('profileLanguage/{id?}', 'SiteController@profileLanguage')->name('profileLanguage');

	Route::get('address', 'SiteController@address')->name('address');
	Route::post('addressstore', 'SiteController@addressstore')->name('addressstore');
	Route::get('add-cookie', 'SiteController@cookie')->name('add-cookie');
	Route::get('/explore-shops/{id}', 'SiteController@vendorProductsPage')->name('site.explore.vendor.products');
	Route::get('/explore-shops/{id}/cat/{cat}', 'SiteController@categoryProducts')->name('site.explore.vendor.cat.products');
	Route::get('allorders','SiteController@allorders')->name('allorders');
	Route::get('return','SiteController@return')->name('return');
	Route::get('wish','SiteController@wishlist')->name('wish');
	Route::get('orderhistory','SiteController@orderhistory')->name('orderhistory');
	Route::get('accountbalance','SiteController@accountbalance')->name('accountbalance');
	Route::get('sitesupport','SiteController@support')->name('site.support');
	Route::get('sitevendor','SiteController@vendor')->name('site.vendor');
	Route::get('subscribtion','SiteController@productsubscription')->name('subscribtion');
	Route::get('wishlist/{id?}','SiteController@wishlistChange')->name('wishlist');
	Route::get('/local/{local}','LanguageController@switch')->name('switch');
	Route::get('privacy','SiteController@privacypolicy')->name('privacypolicy');
	Route::get('terms','SiteController@termsofUser')->name('terms');
	Route::get('datenschutzerklärung','SiteController@datenschutz')->name('datenschutz');
	Route::get('Impressum','SiteController@impressive')->name('Impressum');
	Route::get('feature','SiteController@feature')->name('feature');
	Route::post('/products/autocomplete/fetch', 'Vendor\ProductController@fetchProducts')->name('products.autocomplete.fetch');
	Route::post('cartremove','CartController@removecart')->name('cartremove');
	Route::get('help','SiteController@help')->name('help');



});



// Route::post('addlocation','CartController@checkoutlocation')->name('addlocation');

// Route::get('dashboard', 'SiteController@dashboard')->name('site.dashboard');
// Route::get('checkout', 'PaymentController@checkout')->name('checkout.payment');
Route::post('checkout','PaymentController@checkout')->name('checkout.payment');


Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('banner','HomeController@create')->name('banner');
	Route::post('store','HomeController@store')->name('store');
	Route::resource('orders', 'OrderController');
	Route::get('category', 'VendorCategoryController@index')->name('category-index');
	Route::get('category-create', 'VendorCategoryController@create')->name('category-create');
	Route::post('category-store', 'VendorCategoryController@store')->name('category-store');

	Route::resource('service-requests', 'ServiceRequestController');
	Route::resource('vendors', 'VendorController');
	Route::get('vendors/featured/{id}', 'VendorController@markFeatured')->name('vendors.featured');
    Route::resource('delivery', 'DeliveryController');
	Route::resource('customers', 'CustomerController');
    Route::resource('service-fees', 'ServiceFeesController',
    [ 'only' => ['index', 'edit', 'update']]
    );
    Route::resource('product-reviews', 'ProductReviewsController',
    [ 'only' => ['index', 'destroy']]
	);
	Route::resource('product-var-reviews', 'ProductVariantReviewsController',
    [ 'only' => ['index', 'destroy']]
	);
	Route::resource('vendor-reviews', 'VendorReviewsController',
    [ 'only' => ['index', 'destroy']]
    );
});

Route::group(['namespace' => 'Vendor', 'prefix' => 'vendor', 'middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');

	// Route::get('/', 'HomeController@index')->name('home');
	Route::resource('vendor_orders', 'OrderController');
	Route::resource('services', 'ServiceController');
	Route::resource('products', 'ProductController');
	Route::get('product/upload', 'ProductController@productBulkUpload')->name('product.upload.view');
	Route::post('product/upload', 'ProductController@saveBulkUpload')->name('product.upload');
	Route::resource('product-variants', 'ProductVariantsController');
    Route::get('products/subs/requests', 'ProductController@subscriptionRequest')->name('products.request');
    Route::get('products/subs/requests/status', 'ProductController@subscriptionStatus')->name('products.request.status');
	Route::resource('vendor_customers', 'CustomerController');
	Route::post('order/status/{id?}','OrderController@status')->name('orderstatus');
	Route::get('order/rider/{id?}','OrderController@riderRequest')->name('order.rider');
	Route::get('productstatus/{id?}','ProductController@status')->name('productstatus');
	Route::get('productFeature/{id?}','ProductController@feature')->name('productFeature');

});

Route::group(['namespace' => 'Guest', 'prefix' => 'guest'], function () {

});

Route::group(['namespace' => 'Driver', 'prefix' => 'driver'], function () {

});

Route::group(['namespace' => 'Customer', 'prefix' => 'customer'], function () {

});



Route::get('/home', 'HomeController@index')->name('home')->middleware('premium.customer','verified');
Route::get('editProfile/{id}', 'UserController@showProfile');
Route::get('editUser/{id}','UserController@show');

Route::post('updateUser/{id}','UserController@update');

Route::post('updateProfile/{id}','UserController@updateProfile');

Route::prefix('admin')->group(function () {

});
Route::group(['middleware' => 'auth'], function () {
Route::resource('user', 'UserController', ['except' => ['show']]);

Route::put('user/password', ['as' => 'user.password', 'uses' => 'UserController@password']);
// Route::resource('service', 'ServiceController');
// Route::resource('product', 'ProductsController');
// Route::resource('delivery', 'DeliveryController');

// Route::get('profile', ['as' => 'profile.create', 'uses' => 'ProfileController@create']);
// Route::post('profile', ['as' => 'profile.store', 'uses' => 'ProfileController@store']);
Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

Route::get('payment/success', 'PaymentResultController@successAction');
Route::get('payment/cancel', 'PaymentResultController@cancelAction');



















