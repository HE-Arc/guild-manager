<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * 
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $guild_id
 * @property int $role_id
 * @property int $class_id
 * @property int $faction_id
 * @property int $server_id
 * 
 * @property CharacterClass $character_class
 * @property Faction $faction
 * @property Guild $guild
 * @property Role $role
 * @property Server $server
 * @property GmUser $gm_user
 * @property Collection|Event[] $events
 * @property Collection|History[] $histories
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Character extends Model
{
	protected $table = 'character';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'user_id' => 'int',
		'guild_id' => 'int',
		'role_id' => 'int',
		'class_id' => 'int',
		'faction_id' => 'int',
		'server_id' => 'int'
	];

	protected $fillable = [
		'name',
		'user_id',
		'guild_id',
		'role_id',
		'class_id',
		'faction_id',
		'server_id'
	];

	public function character_class()
	{
		return $this->belongsTo(CharacterClass::class, 'class_id');
	}

	public function faction()
	{
		return $this->belongsTo(Faction::class);
	}

	public function guild()
	{
		return $this->belongsTo(Guild::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function server()
	{
		return $this->belongsTo(Server::class);
	}

	public function gm_user()
	{
		return $this->belongsTo(GmUser::class, 'user_id');
	}

	public function events()
	{
		return $this->belongsToMany(Event::class, 'event_character')
					->withPivot('bench', 'absent');
	}

	public function histories()
	{
		return $this->hasMany(History::class);
	}

	public function items()
	{
		return $this->belongsToMany(Item::class, 'item_character')
					->withPivot('enchant');
	}
}
