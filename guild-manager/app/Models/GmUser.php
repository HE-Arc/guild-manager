<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GmUser
 * 
 * @property int $id
 * @property string $name
 * @property string $password
 * 
 * @property Collection|Character[] $characters
 *
 * @package App\Models
 */
class GmUser extends Model
{
	protected $table = 'gm_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'password'
	];

	public function characters()
	{
		return $this->hasMany(Character::class, 'user_id');
	}
}
