<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventCharacter
 * 
 * @property int $event_id
 * @property int $character_id
 * @property bool $bench
 * @property bool $absent
 * 
 * @property Character $character
 * @property Event $event
 *
 * @package App\Models
 */
class EventCharacter extends Model
{
	protected $table = 'event_character';
	public $incrementing = false;
	public $timestamps = false;

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
