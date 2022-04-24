<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['NotProduct'])->group(function () {


Route::get('','WelcomeController@index')->name('index');
Route::get('/category/{slug}', 'WelcomeController@orderByCat')->name('orderByCat.index');
Route::get('/brand/{slug}', 'WelcomeController@orderByBrand')->name('orderByBrand.index');
Route::get('/price','WelcomeController@orderByPrice')->name('orderByPrice.index');
Route::get('/price_desc', 'WelcomeController@priceDesc')->name('priceDesc.index');
Route::get('/price_asc', 'WelcomeController@priceAsc')->name('priceAsc.index');
Route::get('detail/{slug}','WelcomeController@showDetail')->name('product.showDetail');
Route::get('detail/{slug}/review','ReviewController@index')->name('review.index');
Route::get('/detail/review/delete/{id}','ReviewController@delete')->name('review.delete');
Route::resource('order','OrderController');


});


Route::prefix('dashboard')->middleware(['auth'])->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/home','HomeController@logout')->name('logoutAcc');
    Route::get('/user','UserController@index')->name('user-list');
    Route::post("/make-admin","UserController@makeAdmin")->name("makeAdmin");
    Route::post('/review','ReviewController@store')->name('review.store');


    Route::middleware('isAdmin')->group(function (){
        Route::resource('category','CategoryController');
        Route::resource('brand','BrandController');
        Route::resource('product','ProductController');
        Route::resource('photo','PhotoController');
    });

});


Auth::routes();


Route::prefix('admin')->group(function (){


});


