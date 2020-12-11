<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $date
 * @property string $password
 * @property int $guild_id
 * @property int $location_id
 * 
 * @property Guild $guild
 * @property Location $location
 * @property Collection|Character[] $characters
 * @property Collection|History[] $histories
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'event';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'guild_id' => 'int',
		'location_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'date',
		'password',
		'guild_id',
		'location_id'
	];

	public function guild()
	{
		return $this->belongsTo(Guild::class);
	}

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function characters()
	{
		return $this->belongsToMany(Character::class, 'event_character')
					->withPivot('bench', 'absent');
	}

	public function histories()
	{
		return $this->hasMany(History::class);
	}
}
