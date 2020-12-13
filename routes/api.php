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
Route::post('/tempproduct', 'API\ProductApiController@create');
Route::post('/test', 'API\ProductApiController@test');

Route::get('/trial', 'API\VendorApiController@trial');

Route::post('/email', 'API\EmailApiController@sendEmail')->name('email');

Route::post('/insertbusiness', 'API\BusinessApiController@store');
// Route::post('/insertProduct', 'ProductController@store');
Route::get('/deletebusiness/{id}', 'API\BusinessApiController@destroy');
// Route::get('/list_product', 'ProductController@show')->name('list_product');
// Route::get('/edit_product/{id}', 'ProductController@edit')->name('edit_product');
Route::post('/updatebusiness/{id}', 'API\BusinessApiController@update');

Route::prefix('vendor')->group(function () {
    Route::get('/unauthorized', 'API\VendorLoginController@unauthorized')->name('vendor.unauthorized');
    Route::post('/checkToken', 'API\VendorLoginController@checkToken')->name('vendor.check.token');
Route::post('/login', 'API\VendorLoginController@login');

        Route::middleware(['vendor'])->group(function () {

    });
});
Route::prefix('customer')->group(function () {
    Route::get('/unauthorized', 'API\CustomerLoginController@unauthorized')->name('customer.unauthorized');
    Route::post('/checkToken', 'API\CustomerLoginController@checkToken')->name('customer.check.token');

Route::post('/login', 'API\CustomerLoginController@login');
        Route::middleware(['customer'])->group(function () {

        });
});

Route::post('/insertAddress', 'API\AddressApiController@store');
Route::get('/deleteaddress/{id}', 'API\AddressApiController@destroy');
Route::post('/updateaddress/{id}', 'API\AddressApiController@edit');
