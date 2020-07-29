<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class ApiUsersController extends Controller {

    /**
     * Return the contents of User table in tabular form
     *
     */
    public function getUsersTabular() {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

}
