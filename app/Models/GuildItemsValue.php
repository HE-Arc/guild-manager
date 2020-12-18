<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GuildItemsValue
 * 
 * @property int $item_id
 * @property int $guild_id
 * @property int $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Guild $guild
 * @property Item $item
 *
 * @package App\Models
 */
class GuildItemsValue extends Model
{
	protected $table = 'guild_items_value';
	public $incrementing = false;

	protected $casts = [
		'item_id' => 'int',
		'guild_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'value'
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
