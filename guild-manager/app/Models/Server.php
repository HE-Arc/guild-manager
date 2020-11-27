<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Server
 * 
 * @property int $id
 * @property string $name
 * 
 * @property Collection|Character[] $characters
 * @property Collection|Guild[] $guilds
 *
 * @package App\Models
 */
class Server extends Model
{
	protected $table = 'server';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function characters()
	{
		return $this->hasMany(Character::class);
	}

	public function guilds()
	{
		return $this->hasMany(Guild::class);
	}
}
