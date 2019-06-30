<?php


Route::get('/', 'Pub\HomeController@home_page')->name('home_page');

Auth::routes();

Route::get('/admin', 'Admin\AdminController@index')->name('admin');
Route::get('/api_doc', 'Admin\AdminController@api_doc')->name('api_doc');


// Groups Routing Addresses ( Admin\GroupsController ) :
Route::any('/groups', 'Admin\GroupsController@index')->name('groups');
Route::post('/add_group', 'Admin\GroupsController@add_group')->name('add_group');
Route::get('/edit_group/{id}', 'Admin\GroupsController@edit_group')->name('edit_group')->where('id', '[0-9]+');
Route::post('/edit_group/{id}', 'Admin\GroupsController@update_group')->where('id', '[0-9]+');
Route::any('/remove_group/{id}', 'Admin\GroupsController@remove_group')->name('remove_group')->where('id', '[0-9]+');
Route::get('/group_users/{id}', 'Admin\GroupsController@group_users')->name('group_users')->where('id', '[0-9]+');


// Users Routing Addresses ( Admin\UsersController ) :
Route::any('/users', 'Admin\UsersController@index')->name('users');
Route::post('/add_user', 'Admin\UsersController@add_user')->name('add_user');
Route::get('/edit_user/{id}', 'Admin\UsersController@edit_user')->name('edit_user')->where('id', '[0-9]+');
Route::post('/edit_user/{id}', 'Admin\UsersController@update_user')->where('id', '[0-9]+');
Route::any('/remove_user/{id}', 'Admin\UsersController@remove_user')->name('remove_user')->where('id', '[0-9]+');