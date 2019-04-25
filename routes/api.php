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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'user'], function () {

    Route::post('login', [
        'as'   => 'user/login',
        'uses' => 'Auth\AuthenticateController@login'
    ]);

    Route::post('logout', [
        'as'   => 'user/logout',
        'uses' => 'Auth\AuthenticateController@logout'
    ]);

    Route::get('authenticated', [
        'as'   => 'user/authenticated',
        'uses' => 'Auth\AuthenticateController@getAuthenticatedUser'
    ]);

});

Route::group([
    'prefix'     => 'client',
    'middleware' => ['jwt.auth']
], function () {

    Route::get('selector', [
        'as'   => 'client/selector',
        'uses' => 'ClientController@getSelectors'
    ]);

    Route::get('all', [
        'as'   => 'client/all',
        'uses' => 'ClientController@index'
    ]);

    Route::get('get/{id}', [
        'as'   => 'client/get',
        'uses' => 'ClientController@get'
    ]);

    Route::post('create', [
        'as'   => 'client/create',
        'uses' => 'ClientController@create'
    ]);

    Route::put('update/{id}', [
        'as'   => 'client/update',
        'uses' => 'ClientController@update'
    ]);
});
