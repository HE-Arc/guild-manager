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

Route::get('/users', 'App\Http\Controllers\GmUserController@getGmUsers');
Route::get('/user/{id}', 'App\Http\Controllers\GmUserController@getGmUser');
Route::post('/login', 'App\Http\Controllers\GmUserController@login');
Route::post('/register', 'App\Http\Controllers\GmUserController@register');

Route::post('/postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('/{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
