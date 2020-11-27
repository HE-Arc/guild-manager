<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemCharacter
 * 
 * @property int $item_id
 * @property string|null $enchant
 * @property int $character_id
 * 
 * @property Character $character
 * @property Item $item
 *
 * @package App\Models
 */
class ItemCharacter extends Model
{
	protected $table = 'item_character';
	public $incrementing = false;
	public $timestamps = false;

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
