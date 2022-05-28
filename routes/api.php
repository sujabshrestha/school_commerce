<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', 'App\Http\Controllers\User\UserAuthController@register');

Route::post('/login', 'App\Http\Controllers\User\UserAuthController@login');


Route::group([
    'prefix' => 'category',
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers\Api'
], function() {
    Route::get('/all','ApiCategoryController@allcategories')->name('allcategories');

    Route::get('/categorybyslug/{slug}','ApiCategoryController@CategoryBySlug')->name('categoryBySLug');

    Route::get('/categorybyid/{id}','ApiCategoryController@category')->name('category');
});



Route::group([
    'prefix' => 'product',
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers\Api'
], function() {
    Route::get('/allproduct','ApiProductController@allproduct')->name('allproduct');

    Route::get('/productbyid/{id}','ApiProductController@product')->name('product');

    Route::get('/productbyslug/{slug}','ApiProductController@productBySlug')->name('productBySlug');

    // Route::get('/filterproduct','ApiProductController@filterproduct')->name('filterproduct');

    // Route::post('/productbyprice','ApiProductController@productByPrice')->name('productByPrice');
});
