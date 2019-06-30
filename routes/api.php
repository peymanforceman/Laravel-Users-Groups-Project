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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'API\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::any('logout', 'API\AuthController@logout');
    });
});


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {

    // Groups Routing Addresses ( API\GroupsController ) :
    Route::get('/groups', 'API\GroupsController@index')->name('groups');
    Route::post('/add_group', 'API\GroupsController@add_group')->name('add_group');
    Route::get('/edit_group/{id}', 'API\GroupsController@edit_group')->name('edit_group')->where('id', '[0-9]+');
    Route::post('/edit_group/{id}', 'API\GroupsController@update_group')->where('id', '[0-9]+');
    Route::any('/remove_group/{id}', 'API\GroupsController@remove_group')->name('remove_group')->where('id', '[0-9]+');
    Route::get('/group_users/{id}', 'API\GroupsController@group_users')->name('group_users')->where('id', '[0-9]+');


// Users Routing Addresses ( API\UsersController ) :
    Route::get('/users', 'API\UsersController@index')->name('users');
    Route::post('/add_user', 'API\UsersController@add_user')->name('add_user');
    Route::get('/edit_user/{id}', 'API\UsersController@edit_user')->name('edit_user')->where('id', '[0-9]+');
    Route::post('/edit_user/{id}', 'API\UsersController@update_user')->where('id', '[0-9]+');
    Route::any('/remove_user/{id}', 'API\UsersController@remove_user')->name('remove_user')->where('id', '[0-9]+');
});