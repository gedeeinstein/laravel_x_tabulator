<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    //protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Put 'guest' middleware during controller creation except for logput
        // Except here means 'logout' should only be accessed by logged in users not guest
        $this->middleware('guest')->except('logout');
    }

    /**
     * Overrides default logout: logs out user from system
     *
     * @return void
     */
    public function logout(Request $request) {
        // Use specific guard to log out
        Auth::guard('user')->logout();

        // Invalidates the current session.
        // Clears all session attributes and flashes and regenerates the session and deletes the old session from persistence.
        $request->session()->invalidate();

        // Redirect back to login
        return redirect('/admin/login');
    }

    /**
     * Overrides the default login username to be used by the controller.
     * Default = email but in This Project it's username
     *
     * @return string
     */
    public function username() {
        return 'username';
    }

    /**
     * Overrides default function authenticated in AuthenticatedUsers.php
     * Set up redirect for home page when user is detected as authenticated via successful login
     * This has higher precedence than redirectTo(), so if this is used, no need to use $redirectTo or redirectTo()
     */
    protected function authenticated(Request $request) {

        $redirectTo = 'admin/';

        // Redirect to by default
        return redirect($redirectTo);
    }

}
