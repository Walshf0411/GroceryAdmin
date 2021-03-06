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

Route::get('/about', 'API\StaticTableController@getAbout');
Route::get('/share', 'API\StaticTableController@getShare');
Route::get('/terms', 'API\StaticTableController@getTc');

Route::prefix('/vendor')->group(function () {

    Route::post('/checkToken', 'API\VendorLoginController@checkToken')->name('vendor.check.token');
    Route::get('/getSelectedProducts/{vendor_id}', 'API\ProductApxiController@selectedProducts')->name('vendor.product.list');
    Route::get('/getVendorsTempProducts/{id}','API\TempProductController@vendorsProductList')->name('vendor.tempprod.list');
    Route::post('/login', 'API\VendorLoginController@login')->name('vendor.login');
    //Temp Prodcuts
    Route::get('/deleteTempProduct2/{id}', 'API\TempProduct2ApiController@deleteTempProduct')->name('vendor.tempproduct2.delete');
    Route::post('/addTempProdcut2', 'API\TempProduct2ApiController@addTempProduct')->name('vendor.tempproduct2.add');
    Route::post('/editTempProducts/{id}','API\TempProduct2ApiController@editTempProduct')->name('vendor.edit.tempprodcuts');
    Route::get('/listVendorTempProducts/{id}', 'API\TempProduct2ApiController@listVendorTempProducts')->name('vendor.list.tempprodcuts');
    //Products
    Route::get('/listOfProducts/{id}', 'API\Product2ApiController@getAllVendorProducts')->name('vendor.list.products');
    Route::post('/insertProduct', 'API\Product2ApiController@insertProduct')->name('vendor.insert.products');
    Route::post('/editProduct/{id}', 'API\Product2ApiController@editProduct')->name('vendor.edit.products');
    Route::get('/deleteProduct/{id}', 'API\Product2ApiController@deleteProduct')->name('vendor.delete.products');
    //Vendors
    // Route::get('/getVendorProducts/{id}', 'API\VendorApiController@getAddedProducts')->name('vendor.added.products');
    //Order
    Route::get('getOrderByVendor/{vendorId}', 'API\OrderApiController@getOrderByVendor')->name('vendor.order.list');
});


Route::prefix('/customer')->group(function () {

    Route::post('/checkToken', 'API\CustomerLoginController@checkToken')->name('customer.check.token');
    Route::post('/register', 'API\CustomerLoginController@insertCustomer');
    Route::post('/login', 'API\CustomerLoginController@login')->name('customer.login');
    Route::post('/editCustomer/{id}', 'API\CustomerLoginController@editCustomer');
    //Address
    Route::post('/insertAddress', 'API\AddressApiController@storeAddress');
    Route::get('/deleteAddress/{id}', 'API\AddressApiController@destroyAddress');
    Route::post('/updateAddress/{id}', 'API\AddressApiController@updateAddress');
    Route::get('/listAddress/{id}', 'API\AddressApiController@listAddress');
    //Products
    Route::get('/popularProducts', 'API\Product2ApiController@popularProductsList');
    Route::get('/listProduct', 'API\Product2ApiController@listProduct');
    //Timeslot
    Route::get('/list_timeslot', 'API\TimeslotApiController@listTimeslots')->name('list.timeslot');
    //Delivery Cost
    Route::get('/list_deliverycost', 'API\DeliverycostApiController@listDeliveryCosts')->name('list.deliverycost');
    //Order
    Route::post('/addOrder', 'API\OrderApiController@addOrder')->name('add.order');
    Route::get('/listOrderByCustomer/{id}', 'API\OrderApiController@getOrdersByCustomer')->name('customer.orders');
    Route::get('/cancelOrder/{orderid}', 'API\OrderApiController@cancellOrder')->name('customer.cancel.order');
    //Mode of Payment
    Route::get('/modeOfPayment', 'API\ModeOfPaymentApiController@getAllModes')->name('customer.paymentMode.list');

});


Route::get('/product_category/{id}', 'API\CategoryApiController@list_product_category');




