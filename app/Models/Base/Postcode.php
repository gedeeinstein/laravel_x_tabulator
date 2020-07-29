<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 13 Feb 2019 12:12:22 +0900.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Postcode
 * 
 * @property int $id
 * @property string $public_body_code
 * @property string $old_postcode
 * @property string $postcode
 * @property string $prefecture_kana
 * @property string $city_kana
 * @property string $local_kana
 * @property string $prefecture
 * @property string $city
 * @property string $local
 * @property bool $indicator_1
 * @property bool $indicator_2
 * @property bool $indicator_3
 * @property bool $indicator_4
 * @property bool $indicator_5
 * @property bool $indicator_6
 *
 * @package App\Models\Base
 */
class Postcode extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'indicator_1' => 'bool',
		'indicator_2' => 'bool',
		'indicator_3' => 'bool',
		'indicator_4' => 'bool',
		'indicator_5' => 'bool',
		'indicator_6' => 'bool'
	];
}
