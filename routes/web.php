<?php

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

Route::get('/', 'HomeController@index');

// Tools
Route::get('/tool/demo', 'ToolController@index');
Route::get('/tool/demo_paging', 'ToolController@demo_paging');
Route::get('/tool/demo_hash_password', 'ToolController@demo_hash_password');

// Blogs
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admincp', 'middleware' => ['admin']], function () {

        Route::get('/', 'Admin\HomeController@index');

        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'Admin\BlogController@index');
            Route::get('/create', 'Admin\BlogController@create');
            Route::post('/store', 'Admin\BlogController@store');
            Route::get('/edit/{id}', 'Admin\BlogController@edit');
            Route::post('/update/{id}', 'Admin\BlogController@update');
            Route::get('/delete/{id}', 'Admin\BlogController@delete');
        });

        // Categories
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'Admin\CategoryController@index');
            Route::post('/', 'Admin\CategoryController@index');
            Route::get('/create', 'Admin\CategoryController@create');
            Route::post('/store', 'Admin\CategoryController@store');
            Route::get('/edit/{id}', 'Admin\CategoryController@edit');
            Route::post('/update/{id}', 'Admin\CategoryController@update');
            Route::get('/delete/{id}', 'Admin\CategoryController@delete');
        });

        // Products
        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'Admin\ProductController@index');
            Route::post('/', 'Admin\ProductController@index');
            Route::get('/create', 'Admin\ProductController@create');
            Route::post('/store', 'Admin\ProductController@store');
            Route::get('/edit/{id}', 'Admin\ProductController@edit');
            Route::post('/update/{id}', 'Admin\ProductController@update');
            Route::get('/delete/{id}', 'Admin\ProductController@delete');
        });
    });
});