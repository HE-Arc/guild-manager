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
Route::get('api/users', 'App\Http\Controllers\UserController@getUsers');
Route::get('api/user/{id}', 'App\Http\Controllers\UserController@getUser');
Route::post('api/login', 'App\Http\Controllers\UserController@login');
Route::post('api/register', 'App\Http\Controllers\UserController@register');

// Event
Route::get('api/character/{characterId}/events', 'App\Http\Controllers\EventController@getCharacterSubscriptions');
Route::post('api/event/create', 'App\Http\Controllers\EventController@create');
Route::post('/api/event/{eventId}/update', 'App\Http\Controllers\EventController@updateEvent');
Route::post('/api/event/{eventId}/delete', 'App\Http\Controllers\EventController@deleteEvent');
Route::get('/api/event/{eventId}', 'App\Http\Controllers\EventController@getEvent');


// EventCharacter
Route::post('/api/character/{characterId}/event/{eventId}/bench', 'App\Http\Controllers\SubscriptionController@bench');
Route::post('/api/character/{characterId}/event/{eventId}/unbench', 'App\Http\Controllers\SubscriptionController@unbench');
Route::get('/api/eventCharacters/{eventId}', 'App\Http\Controllers\SubscriptionController@getCharactersByEvent');
Route::post('api/character/{characterId}/event/{eventId}/subscribe', 'App\Http\Controllers\SubscriptionController@subscribe');
Route::post('api/character/{characterId}/event/{eventId}/skip', 'App\Http\Controllers\SubscriptionController@skip');


// Characters
Route::get('api/characters', 'App\Http\Controllers\CharacterController@getMyCharacters');

// Guilds
Route::get('api/guilds', 'App\Http\Controllers\GuildController@getMyGuilds');

// Locations
Route::get('api/locations', 'App\Http\Controllers\LocationController@getLocations');

// Other
Route::post('postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
