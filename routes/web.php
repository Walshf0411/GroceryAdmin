<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Model;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add_category', 'CategoriesController@viewAddCategory');
    Route::post('/insertCategory', 'CategoriesController@store');
Route::get('/deleteCategory/{id}', 'CategoriesController@destroy');
Route::get('/list_category', 'CategoriesController@listCategory')->name('list_category');
Route::get('/edit_category/{id}', 'CategoriesController@edit')->name('edit_category');
    Route::post('/update_category/{id}', 'CategoriesController@update')->name('update_category');


Route::get('/add_banner', 'BannerController@viewAddBanner');
    Route::post('/insertBanner', 'BannerController@store');
Route::get('/deleteBanner/{id}', 'BannerController@destroy');
Route::get('/list_banner', 'BannerController@viewListBanner')->name('list_banner');
Route::get('/edit_banner/{id}', 'BannerController@edit')->name('edit_banner');
    Route::post('/update_banner/{id}', 'BannerController@update')->name('update_banner');
