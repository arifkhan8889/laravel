<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'api'], function() {
  Route::post('category_list','Api\CategoryController@index');
  Route::post('category_add','Api\CategoryController@store');
  Route::post('category_edit','Api\CategoryController@update');
});
