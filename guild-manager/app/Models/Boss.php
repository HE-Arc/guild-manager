<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Boss
 * 
 * @property int $id
 * @property string $name
 * @property int $location_id
 * 
 * @property Location $location
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class Boss extends Model
{
	protected $table = 'boss';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
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
