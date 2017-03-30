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
        Route::get('/post', 'Admin\PostController@index');
        Route::get('/post/create', 'Admin\PostController@create');
        Route::post('/post/store', 'Admin\PostController@store');
        Route::get('/post/edit/{id}', 'Admin\PostController@edit');
        Route::post('/post/update/{id}', 'Admin\PostController@update');
        Route::get('/post/delete/{id}', 'Admin\PostController@delete');
    });
});

// Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
// });
