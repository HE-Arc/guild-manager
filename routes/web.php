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

// GmUser
Route::get('api/users', 'App\Http\Controllers\UserController@getUsers');
Route::get('api/user/{id}', 'App\Http\Controllers\UserController@getUser');
Route::post('api/login', 'App\Http\Controllers\UserController@login');
Route::post('api/register', 'App\Http\Controllers\UserController@register');
Route::post('/api/user/delete', 'App\Http\Controllers\UserController@delete');

// Event
Route::get('api/event/{eventId}', 'App\Http\Controllers\EventController@getEvent');
Route::get('api/character/{characterId}/events', 'App\Http\Controllers\EventController@getCharacterSubscriptions');
Route::post('api/event/create', 'App\Http\Controllers\EventController@create');
Route::post('api/event/update', 'App\Http\Controllers\EventController@update');
Route::post('/api/event/{eventId}/update', 'App\Http\Controllers\EventController@updateEvent');
Route::post('/api/event/{eventId}/delete', 'App\Http\Controllers\EventController@deleteEvent');
Route::get('/api/event/{eventId}', 'App\Http\Controllers\EventController@getEvent');
Route::post('/api/event/{eventId}/run/{locationId}', 'App\Http\Controllers\EventController@run');
Route::get('/api/event/{eventId}/is_running', 'App\Http\Controllers\EventController@isRunning');
Route::post('/api/event/{eventId}/finish', 'App\Http\Controllers\EventController@finish');

// Subscription
Route::get('/api/eventCharacters/{eventId}', 'App\Http\Controllers\SubscriptionController@getCharactersByEvent');
Route::get('/api/event/{eventId}/subscriptions', 'App\Http\Controllers\SubscriptionController@getSubscriptions');
Route::post('api/character/{characterId}/event/{eventId}/subscribe', 'App\Http\Controllers\SubscriptionController@subscribe');
Route::post('api/character/{characterId}/event/{eventId}/skip', 'App\Http\Controllers\SubscriptionController@skip');
Route::post('/api/character/{characterId}/event/{eventId}/bench', 'App\Http\Controllers\SubscriptionController@bench');
Route::post('/api/character/{characterId}/event/{eventId}/unbench', 'App\Http\Controllers\SubscriptionController@unbench');

// History
Route::get('/api/event/{eventId}/histories', 'App\Http\Controllers\HistoryController@getEventHistories');
Route::get('/api/character/{characterId}/histories', 'App\Http\Controllers\HistoryController@getCharacterHistories');
Route::post('/api/history/{historyId}/delete', 'App\Http\Controllers\HistoryController@delete');
Route::post('/api/history/create', 'App\Http\Controllers\HistoryController@create');

// Characters
Route::get('api/character/{characterId}', 'App\Http\Controllers\CharacterController@getCharacter');
Route::get('api/characters', 'App\Http\Controllers\CharacterController@getMyCharacters');
Route::post('api/character/create', 'App\Http\Controllers\CharacterController@create');
Route::post('api/character/update', 'App\Http\Controllers\CharacterController@update');
Route::post('/api/character/{characterId}/delete', 'App\Http\Controllers\CharacterController@delete');

// Guilds
Route::get('api/guild/{guildId}', 'App\Http\Controllers\GuildController@getGuild');
Route::get('api/guild/{guildId}/characters', 'App\Http\Controllers\GuildController@getGuildMembers');
Route::get('api/guilds', 'App\Http\Controllers\GuildController@getMyGuilds');
Route::post('api/guild/create', 'App\Http\Controllers\GuildController@create');
Route::post('api/guild/update', 'App\Http\Controllers\GuildController@update');
Route::post('api/guild/{guildId}/actor/{actorId}/delete', 'App\Http\Controllers\GuildController@delete');
Route::post('api/guild/{guildId}/character/{characterId}/join', 'App\Http\Controllers\GuildController@join');
Route::post('api/guild/{guildId}/character/{characterId}/quit', 'App\Http\Controllers\GuildController@quit');
Route::post('api/guild/{guildId}/actor/{actorId}/target/{targetId}/promote', 'App\Http\Controllers\GuildController@promote');
Route::post('api/guild/{guildId}/actor/{actorId}/target/{targetId}/demote', 'App\Http\Controllers\GuildController@demote');
Route::post('api/guild/{guildId}/actor/{actorId}/target/{targetId}/kick', 'App\Http\Controllers\GuildController@kick');

// Locations
Route::get('api/locations', 'App\Http\Controllers\LocationController@getLocations');

// Bosses
Route::get('api/locationBosses/{location_id}', 'App\Http\Controllers\BossController@getBossesByLocation');
Route::get('api/boss/{boss_id}', 'App\Http\Controllers\BossController@getBoss');

// Items
Route::get('api/bossItems/{boss_id}', 'App\Http\Controllers\ItemController@getItemsByBoss');

// Roles
Route::get('api/roles', 'App\Http\Controllers\RoleController@getRoles');

// Classes
Route::get('api/classes', 'App\Http\Controllers\CharacterClassesController@getCharacterClasses');

// Factions
Route::get('api/factions', 'App\Http\Controllers\FactionController@getFactions');

// Servers
Route::get('api/servers', 'App\Http\Controllers\ServerController@getServers');

// Other
Route::post('postServers', 'App\Http\Controllers\ServerController@postServers');
Route::get('{any}', 'App\Http\Controllers\SpaController@index')->where('any', '.*');
