<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 30 Jul 2020 13:00:11 +0900.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $display_name
 *
 * @package App\Models\Base
 */
class User extends Eloquent
{

}
