<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BannerApiController;

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

Route::get('/homepage', 'API\BannerApiController@show');
Route::get('/category', 'API\BannerApiController@showCategory');
Route::post('/tempvendor', 'API\VendorApiController@create');
Route::post('/tempproduct', 'API\TempProductController@create');
Route::post('/test', 'API\TempProductController@test');

Route::get('/trial', 'API\VendorApiController@trial');

Route::post('/email', 'API\EmailApiController@sendEmail')->name('email');
Route::get('/unauthorized', 'API\CustomerLoginController@unauthorized')->name('unauthorized');
Route::post('/insertbusiness', 'API\BusinessApiController@store');
// Route::post('/insertProduct', 'ProductController@store');
Route::get('/deletebusiness/{id}', 'API\BusinessApiController@destroy');
// Route::get('/list_product', 'ProductController@show')->name('list_product');
// Route::get('/edit_product/{id}', 'ProductController@edit')->name('edit_product');
Route::post('/updatebusiness/{id}', 'API\BusinessApiController@update');

Route::prefix('/vendor')->group(function () {

    Route::post('/checkToken', 'API\VendorLoginController@checkToken')->name('vendor.check.token');
    Route::get('/getSelectedProducts/{vendor_id}', 'API\ProductApiController@selectedProducts')->name('vendor.product.list');
    Route::get('/getVendorsTempProducts/{id}','API\TempProductController@vendorsProductList')->name('vendor.tempprod.list');
    Route::post('/login', 'API\VendorLoginController@login')->name('vendor.login');
    Route::get('/getVendorProducts/{id}', 'API\VendorApiController@getAddedProducts')->name('vendor.added.products');
        Route::middleware('auth:vendor')->group(function () {
    });
});
Route::prefix('customer')->group(function () {

    Route::post('/checkToken', 'API\CustomerLoginController@checkToken')->name('customer.check.token');
    Route::post('/register', 'API\CustomerLoginController@insertCustomer');
Route::post('/login', 'API\CustomerLoginController@login')->name('customer.login');
        Route::middleware(['customer'])->group(function () {
            Route::post('/insertAddress', 'API\AddressApiController@store');
        });
});

Route::get('/deleteaddress/{id}', 'API\AddressApiController@destroy');
Route::post('/updateaddress/{id}', 'API\AddressApiController@edit');

Route::get('/product_category/{id}', 'API\CategoryApiController@list_product_category');
