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

// Route::get("/notification_test", function() {
//     $customer = App\Model\Customer::where("id", 1)->get()[0];
//     $order = App\Model\Orders::where("id", 7)->get()[0];
//     $product = $order->products[0];
//     $product->vendor->notify(new App\Notifications\Vendor\OrderReceivedNotification($product));
//     $customer->notify(new App\Notifications\Customer\OrderPlacedNotification($order));
//     return $order;
// });

Route::get('/homepage', 'API\BannerApiController@show');
Route::get('/category', 'API\BannerApiController@showCategory');
Route::post('/tempvendor', 'API\TempVendorApiController@create');
Route::post('/tempproduct', 'API\TempProductController@create');
Route::post('/test', 'API\TempProductController@test');

Route::get('/trial', 'API\VendorApiController@trial');

Route::get('/otp', 'API\OtpApiController@sendOtp')->name('otp');
Route::get('/unauthorized', 'API\CustomerLoginController@unauthorized')->name('unauthorized');
Route::post('/insertbusiness', 'API\BusinessApiController@store');
// Route::post('/insertProduct', 'ProductController@store');
Route::get('/deletebusiness/{id}', 'API\BusinessApiController@destroy');
// Route::get('/list_product', 'ProductController@show')->name('list_product');
// Route::get('/edit_product/{id}', 'ProductController@edit')->name('edit_product');
Route::post('/updatebusiness/{id}', 'API\BusinessApiController@update');

/** Forgot passsword api */
Route::post("{userType}/forgot_password", 'API\ForgotPasswordController@updatePassword')
                ->name("forgot_password");

Route::get('/about', 'API\StaticTableController@getAbout');
Route::get('/contact', 'API\StaticTableController@getContact');
Route::get('/share', 'API\StaticTableController@getShare');
Route::get('/terms', 'API\StaticTableController@getTc');
Route::get('/getConstant', 'API\StaticTableController@getRpSecretKey');
Route::get('/orderDescription/{id}','API\OrderApiController@getOrderDetails')->name('order.description');
Route::prefix('/vendor')->group(function () {

    Route::post('/update/{id}', 'API\VendorApiController@edit');
    Route::post('/checkToken', 'API\VendorLoginController@checkToken')->name('vendor.check.token');
    Route::get('/getSelectedProducts/{vendor_id}', 'API\ProductApiController@selectedProducts')->name('vendor.product.list');
    Route::get('/getVendorsTempProducts/{id}','API\TempProductController@vendorsProductList')->name('vendor.tempprod.list');
    Route::post('/login', 'API\VendorLoginController@login')->name('vendor.login');
    //Temp Prodcuts
    Route::get('/deleteTempProduct2/{id}', 'API\TempProduct2ApiController@deleteTempProduct')->name('vendor.tempproduct2.delete');
    Route::post('/addTempProdcut2', 'API\TempProduct2ApiController@addTempProduct')->name('vendor.tempproduct2.add');
    Route::post('/editTempProducts/{id}','API\TempProduct2ApiController@editTempProduct')->name('vendor.edit.tempprodcuts');
    Route::get('/listVendorTempProducts/{id}', 'API\TempProduct2ApiController@listVendorTempProducts')->name('vendor.list.tempprodcuts');
    //Products
    Route::get('/listOfProducts/{id}', 'API\Product2ApiController@getAllVendorProducts')->name('vendor.list.products');
    // Route::post('/insertProduct', 'API\Product2ApiController@insertProduct')->name('vendor.insert.products');
    Route::post('/editProduct/{id}', 'API\Product2ApiController@editProduct')->name('vendor.edit.products');
    Route::get('/deleteProduct/{id}', 'API\Product2ApiController@deleteProduct')->name('vendor.delete.products');
    //Vendor Stats
    Route::post('/statistics/{id}', 'API\VendorApiController@vendorStats')->name('vendor.statistics');
    //Vendors
    // Route::get('/getVendorProducts/{id}', 'API\VendorApiController@getAddedProducts')->name('vendor.added.products');
    //Order
    Route::get('getOrderByVendor/{vendorId}', 'API\OrderApiController@getOrderByVendor')->name('vendor.order.list');
    //product check
    Route::post("/productExistsCheck/{id}", 'API\Product2ApiController@productExistsCheck')->name('product.check');
    // notifications
    Route::get("/notifications/read/{userId}", 'API\VendorNotificationsController@getReadNotifications')
            ->name("vendor.notifications.read");

    Route::get("/notifications/unread/{userId}", 'API\VendorNotificationsController@getUnreadNotifications')
            ->name("vendor.notifications.unread");

    Route::get("/notifications/mark/read/{notificationId}", 'API\VendorNotificationsController@markNotificationRead')
            ->name("vendor.notifications.mark.read");

    Route::get("/notifications/mark/read/all/{userId}", 'API\VendorNotificationsController@markNotificationsRead')
            ->name("vendor.notifications.mark.read.all");
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
    Route::post('/cancelOrder/{orderid}', 'API\OrderApiController@cancellOrder')->name('customer.cancel.order');
    Route::post("order/update/status", "API\OrderApiController@updateOrderStatus")->name("customer.update.order.staus");
    //Mode of Payment
    Route::get('/modeOfPayment', 'API\ModeOfPaymentApiController@getAllModes')->name('customer.paymentMode.list');

    // notifications
    Route::get("/notifications/read/{userId}", 'API\CustomerNotificationsController@getReadNotifications')
            ->name("customer.notifications.read");

    Route::get("/notifications/unread/{userId}", 'API\CustomerNotificationsController@getUnreadNotifications')
            ->name("customer.notifications.unread");

    Route::get("/notifications/mark/read/{notificationId}", 'API\CustomerNotificationsController@markNotificationRead')
            ->name("customer.notifications.mark.read");

    Route::get("/notifications/mark/read/all/{userId}", 'API\CustomerNotificationsController@markNotificationsRead')
            ->name("customer.notifications.mark.read.all");
});


Route::get('/product_category/{id}', 'API\CategoryApiController@list_product_category');

Route::prefix('/deliveryboy')->group(function () {
    Route::post('/login',"API\DeliveryBoyController@login" )->name('deliveryboy.login');
    Route::get('/orders/{id}/{orderStatus?}',"API\DeliveryBoyController@getListOfOrdersByRider" )->name('deliveryboy.orders');
    Route::post('/orders/complete/',"API\DeliveryBoyController@completeOrder")->name('deliveryboy.orders.complete');
    Route::get('/status/',"API\DeliveryBoyController@getDeliveryBoyStatus" )->name('deliveryboy.status');
    Route::post('/update/',"API\DeliveryBoyController@updateDeliveryBoyDetails" )->name('deliveryboy.update');
    Route::post('/update/status/',"API\DeliveryBoyController@updateDeliveryBoyStatus" )->name('deliveryboy.update.status');
    Route::get('/profile/{id}', "API\DeliveryBoyController@getDeliveryBoyProfile")->name('deliveryboy.profile');

    // notifications
    Route::get("/notifications/read/{userId}", 'API\DeliveryBoyNotificationsController@getReadNotifications')
            ->name("vendor.notifications.read");

    Route::get("/notifications/unread/{userId}", 'API\DeliveryBoyNotificationsController@getUnreadNotifications')
            ->name("vendor.notifications.unread");

    Route::get("/notifications/mark/read/{notificationId}", 'API\DeliveryBoyNotificationsController@markNotificationRead')
            ->name("vendor.notifications.mark.read");

    Route::get("/notifications/mark/read/all/{userId}", 'API\DeliveryBoyNotificationsController@markNotificationsRead')
            ->name("vendor.notifications.mark.read.all");
});

// Search API
Route::post("/search", "API\SearchController@search")->name("search");

