<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 12:12:22 +0900.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Area
 * 
 * @property int $id
 * @property string $name
 * @property string $display_name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $prefectures
 *
 * @package App\Models\Base
 */
class Area extends Eloquent
{
	public $timestamps = false;

	public function prefectures()
	{
		return $this->hasMany(\App\Models\Prefecture::class);
	}
}
