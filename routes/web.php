<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LoginController@index');
Route::post('login', 'LoginController@login');

Route::get('logout', 'LoginController@logout');

Route::get('registration', 'RegistrationController@index');
Route::post('registration', 'RegistrationController@save');

Route::get('todo/{id}', 'TodoController@index')->middleware('authenticate');
Route::post('todo/add', 'TodoController@save')->middleware('authenticate');
Route::post('todo/update', 'TodoController@update')->middleware('authenticate');
Route::get('todo/show/data', 'TodoController@showData')->middleware('authenticate');
