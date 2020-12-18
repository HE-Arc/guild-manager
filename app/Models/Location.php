<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Boss[] $bosses
 * @property Collection|Event[] $events
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'locations';

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
