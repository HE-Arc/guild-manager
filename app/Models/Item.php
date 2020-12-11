<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $name
 * @property string $rarity
 * @property string $type
 * @property string $icon
 * @property int $boss_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Boss $boss
 * @property Collection|Character[] $characters
 * @property Collection|Guild[] $guilds
 * @property Collection|History[] $histories
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';

	protected $casts = [
		'boss_id' => 'int'
	];

	protected $fillable = [
		'name',
		'rarity',
		'type',
		'icon',
		'boss_id'
	];

	public function boss()
	{
		return $this->belongsTo(Boss::class);
	}

	public function characters()
	{
		return $this->belongsToMany(Character::class, 'character_items')
					->withPivot('enchant')
					->withTimestamps();
	}

	public function guilds()
	{
		return $this->belongsToMany(Guild::class, 'guild_items_value')
					->withPivot('value')
					->withTimestamps();
	}

	public function histories()
	{
		return $this->hasMany(History::class);
	}
}
