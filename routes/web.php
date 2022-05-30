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



Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin',
    'as' => 'admin.'
], function(){

    Route::get('login', 'AuthController@login')->name('login');

    Route::post('login-Submit', 'AuthController@loginSubmit')->name('loginSubmit');

    Route::get('dashboard', 'AuthController@dashboard')->name('dashboard');

    Route::get('logout', 'AuthController@logout')->name('logout');


    Route::group([
        'prefix' => 'category',
        // 'middleware' =>
        'as' => 'category.'
    ], function(){

        Route::get('index', 'CategoryController@index')->name('index');

        Route::get('create', 'CategoryController@create')->name('create');

        Route::post('submit', 'CategoryController@store')->name('submit');

        Route::get('edit/{id}', 'CategoryController@edit')->name('edit');

        Route::post('update/{id}', 'CategoryController@update')->name('update');

        Route::get('delete/{id}', 'CategoryController@destroy')->name('delete');

    });


    Route::group([
        'prefix' => 'product',
        // 'middleware' =>
        'as' => 'product.'
    ], function(){

        Route::get('index', 'ProductController@index')->name('index');

        Route::get('create', 'ProductController@create')->name('create');

        Route::post('submit', 'ProductController@store')->name('submit');

        Route::get('edit/{id}', 'ProductController@edit')->name('edit');

        Route::post('update/{id}', 'ProductController@update')->name('update');

        Route::get('delete/{id}', 'ProductController@destroy')->name('delete');

    });



    Route::group([
        'prefix' => 'order',
        // 'middleware' =>
        'as' => 'order.'
    ], function(){

        Route::get('all', 'OrderController@allOrders')->name('allOrders');

        Route::get('vieworder/{id}', 'OrderController@viewOrder')->name('viewOrder');

        Route::get('changestatus/{id}', 'OrderController@changeStatus')->name('changeStatus');


    });





});



