<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Driver
 * 
 * @property int $id
 * @property int $user_id
 * @property string $gender
 * @property int $seats
 * @property int $child_seats
 * @property string|null $car_type
 * @property string|null $car_color
 * @property string|null $car_spz
 * @property string|null $city
 * @property string|null $country
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $phone
 * @property bool $has_whatsapp
 * @property bool $has_signal
 * @property bool $has_telegram
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Refugee[] $refugees
 *
 * @package App\Models
 */
class Driver extends Model
{
	protected $table = 'drivers';

	protected $casts = [
		'user_id' => 'int',
		'seats' => 'int',
		'child_seats' => 'int',
		'has_whatsapp' => 'bool',
		'has_signal' => 'bool',
		'has_telegram' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'gender',
		'seats',
		'child_seats',
		'car_type',
		'car_color',
		'car_spz',
		'city',
		'country',
		'facebook',
		'twitter',
		'phone',
		'has_whatsapp',
		'has_signal',
		'has_telegram',
		'note'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function refugees()
	{
		return $this->belongsToMany(Refugee::class, 'driver_has_refugee')
					->withPivot('id', 'status');
	}
}
