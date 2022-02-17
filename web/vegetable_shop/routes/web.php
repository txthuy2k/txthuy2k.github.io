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
Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index')->name('home.index');
    Route::get('count','HomeController@create')->name('countcart');
    Route::get('logout','SampleController@Logout')->name('logout');
    Route::get('contact','SampleController@index_contact')->name('contact.index');
    Route::post('contact-send','SampleController@store_contact')->name('contact.store');
    Route::get('about','SampleController@index_about')->name('about.index');
    Route::post('save-cart','SampleController@save_cart')->name('save_cart');
    // Route::post('add-coupon','SampleController@store_coupon')->name('add_coupon.store');
    Route::resource('all-product', 'ProductController');
    Route::resource('wishlist', 'WishlistController');
    Route::resource('detail', 'DetailController');
    Route::resource('cart', 'CartController');
    Route::resource('sign', 'SignUserController')->middleware('CheckUser');

    Route::get('search','ProductController@search')->name('search.index');
});


Route::group(['prefix' => 'admin','namespace'=>'BackEnd'],function(){
    Route::get('/', 'LoginController@index')->name('signin.index')->middleware('CheckUser');
    Route::post('submit-login', 'LoginController@store')->name('signinstore');
    Route::middleware('CheckLoginAdmin')->group(function(){
        Route::resource('dashboard', 'HomeController');
        Route::resource('sign-in', 'SignController');
        Route::resource('product', 'ProductsController');
        Route::resource('category', 'CategoryController');
        // Route::resource('coupon', 'CouponController');
        Route::resource('slider', 'SliderController');
        Route::resource('account', 'AccountController');
        Route::resource('order', 'OrderController');
        Route::resource('profile', 'ProfileController');
    });
});
