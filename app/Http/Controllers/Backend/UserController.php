<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Config;

class UserController extends Controller {

    /**
     * Get named route
     *
     */
    private function getRoute() {
        return 'admin';
    }

    /**
     * Validator for user
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data, $type) {
        // Determine if password validation is required depending on the calling
        return Validator::make($data, [
                'username' => 'required|string|max:255|unique:users,username,' . $data['id'],
                'display_name' => 'required|string|max:100',
                // (update: not required, create: required)
                'password' => 'string|min:6|max:255',
        ]);
    }

    public function index() {
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $user = new User();
        $user->form_action = $this->getRoute() . '.create';
        $user->page_title = 'User Add Page';
        $user->page_type = 'create';
        return view('backend.users.form', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $newUser = $request->all();

        // Validate input, indicate this is 'create' function
        $this->validator($newUser, 'create')->validate();

        try {
            $newUser['password'] = bcrypt($newUser['password']);
            $user = User::create($newUser);
            if ($user) {
                // Create is successful, back to list
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
            } else {
                // Create is failed
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // Create is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $user->form_action = $this->getRoute() . '.update';
        $user->page_title = 'User Edit Page';
        // Add page type here to indicate that the form.blade.php is in 'edit' mode
        $user->page_type = 'edit';
        return view('backend.users.form', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $newUser = $request->all();
        try {
            $currentUser = User::find($request->get('id'));
            if ($currentUser) {
                // If password input is empty this means we take the old password value as is from DB
                if (!$newUser['password']) {
                    $newUser['password'] = $currentUser['password'];
                }
                // Validate input only after getting password, because if not validator will keep complaining that password does not meet validation rules
                // Hashed password from DB will always have length of 60 characters so it will pass validation
                // Also indicate this is 'update' function
                $this->validator($newUser, 'update')->validate();

                // Only hash the password if it needs to be hashed
                if (Hash::needsRehash($newUser['password'])) {
                    $newUser['password'] = bcrypt($newUser['password']);
                }

                // Update user
                $currentUser->update($newUser);
                // If update is successful
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_UPDATE_MESSAGE'));
            } else {
                // If update is failed
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_UPDATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // If update is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_UPDATE_MESSAGE'));
        }
    }

    public function delete(Request $request) {
        try {
            // Get user by id
            $user = User::find($request->get('id'));
            // If to-delete user is not the one currently logged in, proceed with delete attempt
            if (Auth::id() != $user->id) {

                // Delete user
                $user->delete();

                // If delete is successful
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_DELETE_MESSAGE'));
            }
            // Send error if logged in user trying to delete himself
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_SELF_MESSAGE'));
        } catch (Exception $e) {
            // If delete is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_MESSAGE'));
        }
    }

}
