<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * 
 * @property Collection|Character[] $characters
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'role';
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
}
