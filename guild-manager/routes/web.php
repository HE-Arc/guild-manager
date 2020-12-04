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

Route::get('/getGmUsers/{id}', 'App\Http\Controllers\GmUserController@getGmUsers');
Route::post('/postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('/{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
