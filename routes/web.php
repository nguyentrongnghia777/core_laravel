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
    });
});
