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
Route::get('/api/users', 'App\Http\Controllers\GmUserController@getGmUsers');
Route::get('/api/user/{id}', 'App\Http\Controllers\GmUserController@getGmUser');
Route::post('/api/login', 'App\Http\Controllers\GmUserController@login');
Route::post('/api/register', 'App\Http\Controllers\GmUserController@register');

// Event
Route::get('/api/character/{characterId}/events', 'App\Http\Controllers\EventController@getCharacterEvents');


// EventCharacter
Route::post('/api/character/{characterId}/event/{eventId}/subscribe', 'App\Http\Controllers\EventCharacterController@subscribe');
Route::post('/api/character/{characterId}/event/{eventId}/skip', 'App\Http\Controllers\EventCharacterController@skip');
Route::post('/api/character/{characterId}/event/{eventId}/bench', 'App\Http\Controllers\EventCharacterController@bench');
Route::post('/api/character/{characterId}/event/{eventId}/unbench', 'App\Http\Controllers\EventCharacterController@unbench');
Route::get('/api/event/{eventId}', 'App\Http\Controllers\EventCharacterController@getCharactersByEvent');


// Characters
Route::get('/api/characters', 'App\Http\Controllers\CharacterController@getMyCharacters');

// Other
Route::post('/postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('/{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
