<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Boss
 * 
 * @property int $id
 * @property string $name
 * @property int $location_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Location $location
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Boss extends Model
{
	protected $table = 'bosses';

	protected $casts = [
		'location_id' => 'int'
	];

	protected $fillable = [
		'name',
		'location_id'
	];

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function items()
	{
		return $this->hasMany(Item::class);
	}
}
