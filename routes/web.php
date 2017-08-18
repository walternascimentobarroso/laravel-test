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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', 'ProductController', ['except' => ['update']]);

Route::resource('user', 'UserController', ['except' => ['update']]);

Route::post('product/{id}', 'ProductController@update');
Route::post('user/{id}', 'UserController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'auth/github'], function(){
    Route::get('/', 'GitHubController@redirect');
    Route::get('callback', 'GitHubController@handle');
});
