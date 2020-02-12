<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\FailedLoginAttempt;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }


        $failedAttempts = FailedLoginAttempt::where('email_address', $user->email)->get();
        $count = count($failedAttempts);

        if( $count >= 5){
            auth()->logout();
            return back()->with('warning', 'Your account has been disabled due to excessive failed log in attempts. Use forgot password feature to retrieve it.');
        
        }
        else{
            $failedAttempts = FailedLoginAttempt::where('email_address', $user->email)->delete();
        }
        

        if($user->change_pass){
            return redirect('/MustChangePass');
        }




        return redirect()->intended($this->redirectPath());
    }
}
