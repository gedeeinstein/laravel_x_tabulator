<?php

namespace App\Models;

class Company extends \App\Models\Base\Company
{
	protected $casts = [
		'prefecture_id' => 'int'
	];

	protected $fillable = [
		'name',
		'email',
		'prefecture_id',
		'phone',
		'postcode',
		'city',
		'local',
		'street_address',
		'business_hour',
		'regular_holiday',
		'image',
		'fax',
		'url',
		'license_number',
		'image'
	];
}
