<?php

namespace App\Models;

class Prefecture extends \App\Models\Base\Prefecture
{
	protected $fillable = [
		'name',
		'display_name',
		'area_id'
	];
}
