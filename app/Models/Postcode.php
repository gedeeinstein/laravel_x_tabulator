<?php

namespace App\Models;

class Postcode extends \App\Models\Base\Postcode
{
	protected $fillable = [
		'public_body_code',
		'old_postcode',
		'postcode',
		'prefecture_kana',
		'city_kana',
		'local_kana',
		'prefecture',
		'city',
		'local',
		'indicator_1',
		'indicator_2',
		'indicator_3',
		'indicator_4',
		'indicator_5',
		'indicator_6'
	];
}
