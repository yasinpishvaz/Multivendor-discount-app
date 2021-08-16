<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(\Illuminate\Http\Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
    
        // change this section because we want only active users can login
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();
    
            // Make sure the user status is 1 or is active user
            if ($user->status == 1 && $this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            } else {
                $this->incrementLoginAttempts($request);
                return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['isBlock' => 'حساب شما غیر فعال است!']);
            }
        }
    
        $this->incrementLoginAttempts($request);
    
        return $this->sendFailedLoginResponse($request);
    }



    public function showLoginForm()
    {
        return view('front.auth.login');
    }


    // where to redirect users after login 
    public function redirectTo()
    {
        //user role
        $role = Auth::user()->role;

        //check user role  and redirect them to related route/view
        switch ($role) {
            case 'admin':
                return '/back/dashboard';
                break;

            case 'merchant':
                return '/merchant/panel/editprofile';
                break;

                case 'customer':
                    return '/';
                    break;

            default:
                return 'login';
                break;
        }
    }
}
