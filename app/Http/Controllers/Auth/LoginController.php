<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function authenticated()
    {
        if(Auth::user()->role_id == '1'){
            return redirect('/admin')->with('status', "Welcome to Admin Dashboard");
        }
        else if(Auth::user()->role_id == '3'){
            return redirect('/admin')->with('status', "Welcome to Mechanic Dashboard");
        }
        else if(Auth::user()->role_id == '2'){
            return redirect('/')->with('status', "Welcome to Customer Dashboard");
        }
        else{
            return redirect('/')->with('status', "Login successful");
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
