<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * 
 * @property int $id
 * @property int $event_id
 * @property int $character_id
 * @property int $item_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Character $character
 * @property Event $event
 * @property Item $item
 *
 * @package App\Models
 */
class History extends Model
{
	protected $table = 'histories';

	protected $casts = [
		'event_id' => 'int',
		'character_id' => 'int',
		'item_id' => 'int'
	];

	protected $fillable = [
		'event_id',
		'character_id',
		'item_id'
	];

	public function character()
	{
		return $this->belongsTo(Character::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
