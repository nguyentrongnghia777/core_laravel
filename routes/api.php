<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'Api\UserController@login');
});

Route::group(['prefix' => 'tools'], function () {
    Route::get('hello', function () {
        return 'hello';
    });

    Route::get('get_hello_by_id/{id}', function ($id) {
        return $id;
    });

    Route::get('get_hello_by_id', function (Illuminate\Http\Request $request) {
        return $request->id;
    });

    Route::get('get_multiparam', function (Illuminate\Http\Request $request) {
        $name = $request->name;
        $id = $request->id;
        return $id;
    });

    Route::get('blog', 'Api\ToolController@get_blogs');
    Route::get('blog/{id}', 'Api\ToolController@get_blog');
    Route::post('blog', 'Api\ToolController@create_blog');
    Route::put('blog/{id}', 'Api\ToolController@update_blog');
    Route::delete('blog/{id}', 'Api\ToolController@delete_blog');

    Route::get('users/{user}', function (App\User $user) {
        return $user;
    });
});
