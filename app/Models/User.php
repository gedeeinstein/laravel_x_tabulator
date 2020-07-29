<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPasswordNotification;
use Config;

class User extends \App\Models\Base\User implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    // Always remember to put necessary traits inside class after defining them below namespace
    // These traits are used by default for user login authentication
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        Notifiable;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'username',
		'password',
		'remember_token',
		'display_name'
	];

	/**
     * Override the default function to send password reset notification
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new UserResetPasswordNotification($token));
    }
}
