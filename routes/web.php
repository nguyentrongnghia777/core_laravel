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
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admincp', 'Admin\HomeController@index');
        Route::get('/blog', 'Admin\BlogController@index');
        Route::get('/blog/create', 'Admin\BlogController@create');
        Route::post('/blog/store', 'Admin\BlogController@store');
        Route::get('/blog/edit/{id}', 'Admin\BlogController@edit');
        Route::post('/blog/update/{id}', 'Admin\BlogController@update');
        Route::get('/blog/delete/{id}', 'Admin\BlogController@delete');
    });
});

// Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
// });
