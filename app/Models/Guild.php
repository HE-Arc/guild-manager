<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Guild
 * 
 * @property int $id
 * @property string $name
 * @property int $faction_id
 * @property int $server_id
 * @property string|null $password
 * 
 * @property Faction $faction
 * @property Server $server
 * @property Collection|Character[] $characters
 * @property Collection|Event[] $events
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Guild extends Model
{
	protected $table = 'guild';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'faction_id' => 'int',
		'server_id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'faction_id',
		'server_id',
		'password'
	];

	public function faction()
	{
		return $this->belongsTo(Faction::class);
	}

	public function server()
	{
		return $this->belongsTo(Server::class);
	}

	public function characters()
	{
		return $this->hasMany(Character::class);
	}

	public function events()
	{
		return $this->hasMany(Event::class);
	}

	public function items()
	{
		return $this->belongsToMany(Item::class, 'item_guild');
	}
}
