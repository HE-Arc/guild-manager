<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemGuild
 * 
 * @property int $item_id
 * @property int $guild_id
 * 
 * @property Guild $guild
 * @property Item $item
 *
 * @package App\Models
 */
class ItemGuild extends Model
{
	protected $table = 'item_guild';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'item_id' => 'int',
		'guild_id' => 'int'
	];

	public function guild()
	{
		return $this->belongsTo(Guild::class);
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
