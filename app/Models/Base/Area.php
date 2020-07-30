<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 30 Jul 2020 13:00:11 +0900.
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
