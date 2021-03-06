<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Server
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Character[] $characters
 * @property Collection|Guild[] $guilds
 *
 * @package App\Models
 */
class Server extends Model
{
	protected $table = 'servers';

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
