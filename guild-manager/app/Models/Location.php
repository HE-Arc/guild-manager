<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property string $name
 * 
 * @property Collection|Boss[] $bosses
 * @property Collection|Event[] $events
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'location';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'name'
	];

	public function bosses()
	{
		return $this->hasMany(Boss::class);
	}

	public function events()
	{
		return $this->hasMany(Event::class);
	}
}
