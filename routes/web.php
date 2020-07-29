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

/*
  |--------------------------------------------------------------------------
  | Frontend Routes
  |--------------------------------------------------------------------------
 */

// By default laravel is using routes from Auth::routes() created from php artisan make:auth
// Auth::routes()
//
// However in our application we need to create the routes manually
// Default login routes from Auth::routes()
Route::GET('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::GET('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::POST('admin/login', 'Auth\LoginController@login')->name('login');
// This prevents user from accessing logout via url
Route::GET('logout', 'Auth\LoginController@logout')->name('logout');

// No need registration for this project

// No need forgot password for this project

/*
  |--------------------------------------------------------------------------
  | Backend Routes
  |--------------------------------------------------------------------------
 */

// Admin backend routes - accessible after successful login
Route::GROUP(['middleware' => ['auth:user']], function() {

    // Logout
    Route::POST('logout', 'Auth\LoginController@logout')->name('logout');

    // Admin (handles users account)
    Route::GET('/admin', 'Backend\UserController@index')->name('admin');
    Route::GET('/admin/add', 'Backend\UserController@add')->name('admin.add');
    Route::POST('/admin/create', 'Backend\UserController@create')->name('admin.create');
    Route::GET('/admin/edit/{id}', 'Backend\UserController@edit')->name('admin.edit');
    Route::POST('/admin/update', 'Backend\UserController@update')->name('admin.update');
    Route::GET('/admin/delete', 'Backend\UserController@delete')->name('admin.delete');
});
