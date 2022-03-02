<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PlaceOfDeparture
 * 
 * @property int $id
 * @property string|null $en
 * @property string|null $cs
 * @property string|null $pl
 * @property string|null $sk
 * @property string|null $hu
 * @property string|null $rum
 * @property string|null $de
 * 
 * @property Collection|Refugee[] $refugees
 *
 * @package App\Models
 */
class PlaceOfDeparture extends Model
{
	protected $table = 'place_of_departures';
	public $timestamps = false;

	protected $fillable = [
		'en',
		'cs',
		'pl',
		'sk',
		'hu',
		'rum',
		'de'
	];

	public function refugees()
	{
		return $this->hasMany(Refugee::class);
	}
}
