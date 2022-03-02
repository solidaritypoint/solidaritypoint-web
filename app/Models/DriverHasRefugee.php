<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DriverHasRefugee
 * 
 * @property int $id
 * @property int $driver_id
 * @property int $refugee_id
 * @property string $status
 * @property Carbon $created_at
 * 
 * @property Driver $driver
 * @property Refugee $refugee
 *
 * @package App\Models
 */
class DriverHasRefugee extends Model
{
	protected $table = 'driver_has_refugee';
	public $timestamps = false;

	protected $casts = [
		'driver_id' => 'int',
		'refugee_id' => 'int'
	];

	protected $fillable = [
		'driver_id',
		'refugee_id',
		'status'
	];

	public function driver()
	{
		return $this->belongsTo(Driver::class);
	}

	public function refugee()
	{
		return $this->belongsTo(Refugee::class);
	}
}
