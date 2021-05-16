<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Model;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes(['register' => false]); //,  'reset' => false
// Route::get('/walshtmp', function() {
// 	return ("hello walsh");
// });

Route::match(array("GET", "POST"), '/deploy/asdfghjkl', function() {
    $commands = array(
        ["git", "pull", "git@github.com:Walshf0411/GroceryAdmin.git"],
        ["cp", "-af", "public/.", "../public_html"],
        ["cp", "-af", ".", "../"],
        ["unlink", "/home1/creatio5/public_html/storage"],
        ["ln", "-s", "/home1/creatio5/storage/app/public", "/home1/creatio5/public_html/storage"],
        ["git", "status"],
    );

    echo "Starting to deploy<br>";

    foreach($commands as $cmd) {
        echo "<br>Running command: ".implode(" ", $cmd);

        $process = new Process($cmd);
        $process->setWorkingDirectory("/home1/creatio5/GroceryAdmin");
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        echo "<br>Command output: ".$process->getOutput();
        echo "<br>";
    }
});

Route::get('/', 'HomeController@index')->name('');
Route::get('/home', 'HomeController@index')->name('home');

//Category
Route::get('/add_category', 'CategoriesController@viewAddCategory')->name('add_category');
Route::post('/insertCategory', 'CategoriesController@store');
Route::get('/deleteCategory/{id}', 'CategoriesController@destroy');
Route::get('/list_category', 'CategoriesController@listCategory')->name('list_category');
Route::get('/edit_category/{id}', 'CategoriesController@edit')->name('edit_category');
Route::post('/update_category/{id}', 'CategoriesController@update')->name('update_category');

//Banner
Route::get('/add_banner', 'BannerController@viewAddBanner')->name('add_banner');
Route::post('/insertBanner', 'BannerController@store');
Route::get('/deleteBanner/{id}', 'BannerController@destroy');
Route::get('/list_banner', 'BannerController@viewListBanner')->name('list_banner');
Route::get('/edit_banner/{id}', 'BannerController@edit')->name('edit_banner');
Route::post('/update_banner/{id}', 'BannerController@update')->name('update_banner');

//Product
Route::get('/add_product', 'Product2Controller@index');
Route::post('/insertProduct', 'Product2Controller@store');
Route::get('/deleteProduct/{id}', 'Product2Controller@destroy')->name('deleteProduct');
Route::get('/listProduct', 'Product2Controller@show')->name('listProduct');
Route::get('/edit_product/{id}', 'Product2Controller@edit')->name('edit_product');
Route::post('/update_product/{id}', 'Product2Controller@update')->name('update_product');
Route::get('/productDetails/{id}', 'Product2Controller@listProduct')->name('listProductDetails');

//TempProduct
Route::get('/listTempProduct', 'TempProduct2Controller@show')->name('listTempProduct');
Route::get('/rejectedTempProduct/{id}', 'TempProduct2Controller@destroy')->name('tempDeleteProduct');
Route::get('/approveTempProduct/{id}', 'TempProduct2Controller@store');

//Vendor
Route::get('/list_vendor', 'VendorController@listVendor')->name('list_vendor');
Route::get('/list_blocked_vendor', 'VendorController@show_block_vendor')->name('list_blocked_vendor');
Route::get('/delete_block_vendor/{id}', 'VendorController@destroy');
Route::get('/delete_unblock_vendor/{id}', 'VendorController@destroy_blockedVendor');
Route::get('/block_Vendor/{id}', 'VendorController@update_block_vendor');
Route::get('/unblock_Vendor/{id}', 'VendorController@update_unblock_vendor');
Route::get('/vendorProfile/{id}', 'VendorController@getVendorProfile')->name('list_vendorprofile');

//TempVendor
Route::get('/list_temp_vendor', 'TempVendorController@show')->name('list_temp_vendor');
Route::get('/delete_temp_Vendor/{id}', 'TempVendorController@destroy');
Route::get('/add_temp_Vendor/{id}', 'TempVendorController@store');
Route::get('/list_vendor_products', 'BusinessController@show');



//Customer
Route::get('/list_customer', 'CustomerController@listCustomer')->name('list_customer');
Route::get('/customerProfile/{id}', 'CustomerController@getCustomerProfile')->name('list_customerprofile');


//Timeslot
Route::get('/add_timeslot', 'TimeslotController@viewAddTimeslot')->name('add_timeslot');
Route::post('/insertTimeslot', 'TimeslotController@store');
Route::get('/deleteTimeslot/{id}', 'TimeslotController@destroy');
Route::get('/list_timeslot', 'TimeslotController@listTimeslots')->name('list_timeslot');
Route::get('/edit_timeslot/{id}', 'TimeslotController@edit')->name('edit_timeslot');
Route::post('/update_timeslot/{id}', 'TimeslotController@update')->name('update_timeslot');

//Deliverycost
Route::get('/add_deliverycost', 'DeliverycostController@viewAddDeliveryCost')->name('add_deliverycost');
Route::post('/insertDeliveryCost', 'DeliverycostController@store');
Route::get('/deletedeliveryCost', 'DeliverycostController@destroy');
Route::get('/list_deliverycost', 'DeliverycostController@listDeliveryCost')->name('list_deliverycost');
Route::get('/edit_deliverycost', 'DeliverycostController@edit')->name('edit_deliverycost');
Route::post('/update_deliverycost', 'DeliverycostController@update')->name('update_deliverycost');

//Order
Route::get('/listCustomerOrder/{id}', 'OrderController@getOrdersByCustomer')->name('list_customerorder');
// Route::get('/list_order/{id}', 'OrderController@showOrderDetails')->name('list_order');
Route::get('/list_order', 'OrderController@listOrders')->name('list_order');
Route::get('/pending_order', 'OrderController@pendingOrders')->name('pending_order');
Route::get('/completed_order', 'OrderController@completedOrders')->name('completed_order');
Route::get('/cancelled_order', 'OrderController@cancelledOrders')->name('cancelled_order');
Route::get('/unassignedOrder', 'OrderController@unassignedOrders')->name('order.unassigned');
Route::get('/showAddress/{id}', 'AddressController@getAddress')->name('show_orderaddress');
Route::get('/showCustomer/{id}', 'CustomerController@getCustomer')->name('show_ordercustomer');
Route::get('/orderDetails/{id}', 'OrderController@orderDetails')->name('show_orderdetails');
Route::get('/total/{id}', 'Product2Controller@total')->name('total');
Route::get('/order/delete/{id}', 'OrderController@deleteOrder')->name('order.delete');
Route::get('/order/edit/{id}', 'OrderController@editOrder')->name('order.edit');
Route::post('/order/update/{id}', 'OrderController@updateOrder')->name('order.update');
//Address
Route::get('/listAddress/{id}', 'AddressController@listAddress')->name('list_address');

//Static Pages
Route::get('/showTc', 'StaticTableController@viewTc')->name('showTc');
Route::post('/addTc', 'StaticTableController@addTc');
Route::get('/showAbout', 'StaticTableController@viewAbout')->name('showAbout');
Route::post('/addAbout', 'StaticTableController@addAboutUs');
Route::get('/showShare', 'StaticTableController@viewShare')->name('showShare');
Route::post('/addShare', 'StaticTableController@addShare');


//Delivery Boy
Route::post("/addDeliveryBoy", "DeliveryBoyController@addDeliveryBoy")->name("deliveryBoy.add");
Route::get("/deleteDeliveryBoy/{id}", "DeliveryBoyController@deleteDeliveryBoy")->name("deliveryBoy.delete");
Route::get("/viewAddDeliveryBoy", "DeliveryBoyController@viewAddDeliveryBoyPage")->name("deliveryBoy.view.add");
Route::post("/editDeliveryBoy/{id}", "DeliveryBoyController@editDeliveryBoy")->name("deliveryBoy.edit");
Route::get("/viewEditDeliveryBoy/{id}", "DeliveryBoyController@viewEditDeliveryBoyPage")->name("deliveryBoy.view.edit");
Route::get("/listDeliveryBoy", "DeliveryBoyController@listDeliveryBoys")->name("deliveryBoy.list");
Route::get("/viewDeliveryBoy/{id}", "DeliveryBoyController@viewDeliveryBoy")->name("deliveryBoy.profile");
