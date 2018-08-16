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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/tasks', 'TaskController@index');
Route::get('/task', 'TaskController@show');
Route::post('/task', 'TaskController@store');

Route::get('/task/{id}', 'TaskController@edit');
Route::post('/task/{id}', 'TaskController@update');
Route::delete('/task/{id}', 'TaskController@destroy');
