<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Refugee
 * 
 * @property int $id
 * @property int $user_id
 * @property int $place_of_departure_id
 * @property int $people_in_group
 * @property int $adults_in_group
 * @property int $kids_in_group
 * @property string|null $note
 * @property string $gender
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $phone
 * @property int $age
 * @property bool $has_whatsapp
 * @property bool $has_signal
 * @property bool $has_telegram
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property PlaceOfDeparture $place_of_departure
 * @property User $user
 * @property Collection|Driver[] $drivers
 * @property Collection|RefugeeCompanion[] $refugee_companions
 *
 * @package App\Models
 */
class Refugee extends Model
{
	protected $table = 'refugees';

	protected $casts = [
		'user_id' => 'int',
		'place_of_departure_id' => 'int',
		'people_in_group' => 'int',
		'adults_in_group' => 'int',
		'kids_in_group' => 'int',
		'age' => 'int',
		'has_whatsapp' => 'bool',
		'has_signal' => 'bool',
		'has_telegram' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'place_of_departure_id',
		'people_in_group',
		'adults_in_group',
		'kids_in_group',
		'note',
		'gender',
		'facebook',
		'twitter',
		'phone',
		'age',
		'has_whatsapp',
		'has_signal',
		'has_telegram'
	];

	public function place_of_departure()
	{
		return $this->belongsTo(PlaceOfDeparture::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function drivers()
	{
		return $this->belongsToMany(Driver::class, 'driver_has_refugee')
					->withPivot('id', 'status');
	}

	public function refugee_companions()
	{
		return $this->hasMany(RefugeeCompanion::class);
	}
}
