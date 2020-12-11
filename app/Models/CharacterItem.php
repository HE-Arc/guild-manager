<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CharacterItem
 * 
 * @property int $item_id
 * @property int $character_id
 * @property string $enchant
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Character $character
 * @property Item $item
 *
 * @package App\Models
 */
class CharacterItem extends Model
{
	protected $table = 'character_items';
	public $incrementing = false;

	protected $casts = [
		'item_id' => 'int',
		'character_id' => 'int'
	];

	protected $fillable = [
		'enchant'
	];

	public function character()
	{
		return $this->belongsTo(Character::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
