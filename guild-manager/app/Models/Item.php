<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

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
 * 
 * @property Boss $boss
 * @property Collection|History[] $histories
 * @property Collection|Character[] $characters
 * @property Collection|Guild[] $guilds
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'item';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
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

	public function histories()
	{
		return $this->hasMany(History::class);
	}

	public function characters()
	{
		return $this->belongsToMany(Character::class, 'item_character')
					->withPivot('enchant');
	}

	public function guilds()
	{
		return $this->belongsToMany(Guild::class, 'item_guild');
	}
}
