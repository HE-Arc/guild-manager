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
 * @property Carbon $subscription_delay
 * @property int $player_count
 * @property bool $auto_bench
 * @property string $password
 * @property int|null $guild_id
 * @property int|null $location_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guild|null $guild
 * @property Location|null $location
 * @property Collection|History[] $histories
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';

	protected $casts = [
		'player_count' => 'int',
		'auto_bench' => 'bool',
		'guild_id' => 'int',
		'location_id' => 'int'
	];

	protected $dates = [
		'date',
		'subscription_delay'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'date',
		'subscription_delay',
		'player_count',
		'auto_bench',
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

	public function histories()
	{
		return $this->hasMany(History::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
