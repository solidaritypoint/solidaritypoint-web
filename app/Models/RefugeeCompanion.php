<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefugeeCompanion
 * 
 * @property int $id
 * @property int $refugee_id
 * @property int $age
 * @property string $gender
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Refugee $refugee
 *
 * @package App\Models
 */
class RefugeeCompanion extends Model
{
	protected $table = 'refugee_companion';

	protected $casts = [
		'refugee_id' => 'int',
		'age' => 'int'
	];

	protected $fillable = [
		'refugee_id',
		'age',
		'gender'
	];

	public function refugee()
	{
		return $this->belongsTo(Refugee::class);
	}
}
