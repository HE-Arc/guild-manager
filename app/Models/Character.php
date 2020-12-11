<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
 * @property int $character_class_id
 * @property int $faction_id
 * @property int $server_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CharacterClass $character_class
 * @property Faction $faction
 * @property Guild $guild
 * @property Role $role
 * @property Server $server
 * @property User $user
 * @property Collection|Item[] $items
 * @property Collection|History[] $histories
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models
 */
class Character extends Model
{
	protected $table = 'characters';

	protected $casts = [
		'user_id' => 'int',
		'guild_id' => 'int',
		'role_id' => 'int',
		'character_class_id' => 'int',
		'faction_id' => 'int',
		'server_id' => 'int'
	];

	protected $fillable = [
		'name',
		'user_id',
		'guild_id',
		'role_id',
		'character_class_id',
		'faction_id',
		'server_id'
	];

	public function character_class()
	{
		return $this->belongsTo(CharacterClass::class);
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

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function items()
	{
		return $this->belongsToMany(Item::class, 'character_items')
					->withPivot('enchant')
					->withTimestamps();
	}

	public function histories()
	{
		return $this->hasMany(History::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
