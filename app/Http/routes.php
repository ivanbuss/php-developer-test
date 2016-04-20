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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('user/{user}/delete', 'Users\DeleteController@index');

Route::get('user/add', 'Users\CreateController@index');
Route::post('user/add', 'Users\CreateController@postCreate');

Route::get('user/{user}/edit', 'Users\EditController@index');
Route::post('user/{user}/edit', 'Users\EditController@postUpdate');

Route::get('user/{user}/view', 'Users\ViewController@index');
