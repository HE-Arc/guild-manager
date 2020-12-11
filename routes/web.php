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

// User
Route::get('/api/users', 'App\Http\Controllers\UserController@getUsers');
Route::get('/api/user/{id}', 'App\Http\Controllers\UserController@getUser');
Route::post('/api/login', 'App\Http\Controllers\UserController@login');
Route::post('/api/register', 'App\Http\Controllers\UserController@register');

// Event
Route::get('/api/character/{characterId}/events', 'App\Http\Controllers\EventController@getCharacterSubscriptions');

// EventCharacter
Route::post('/api/character/{characterId}/event/{eventId}/subscribe', 'App\Http\Controllers\SubscriptionController@subscribe');
Route::post('/api/character/{characterId}/event/{eventId}/skip', 'App\Http\Controllers\SubscriptionController@skip');

// Characters
Route::get('/api/characters', 'App\Http\Controllers\CharacterController@getMyCharacters');

// Other
Route::post('/postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('/{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
