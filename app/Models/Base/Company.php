<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 12:12:22 +0900.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $prefecture_id
 * @property string $phone
 * @property string $postcode
 * @property string $city
 * @property string $local
 * @property string $street_address
 * @property string $business_hour
 * @property string $regular_holiday
 * @property string $image
 * @property string $fax
 * @property string $url
 * @property string $license_number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Prefecture $prefecture
 *
 * @package App\Models\Base
 */
class Company extends Eloquent
{
	protected $casts = [
		'prefecture_id' => 'int'
	];

	public function prefecture()
	{
		return $this->belongsTo(\App\Models\Prefecture::class);
	}
}
