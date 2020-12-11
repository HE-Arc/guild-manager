<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * 
 * @property int $event_id
 * @property int $character_id
 * @property bool $bench
 * @property bool $absent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Character $character
 * @property Event $event
 *
 * @package App\Models
 */
class Subscription extends Model
{
	protected $table = 'subscriptions';
	public $incrementing = false;

	protected $casts = [
		'event_id' => 'int',
		'character_id' => 'int',
		'bench' => 'bool',
		'absent' => 'bool'
	];

	protected $fillable = [
		'bench',
		'absent'
	];

	public function character()
	{
		return $this->belongsTo(Character::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
