<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
      if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
        // DB::table('users')->where('email', $request['email'])->update(['last_active' => NOW()]);
        return redirect()->route('dashboard');
      }
      else{
        return redirect()->back()->with('message', 'Login details incorrect!');
      }
    }

    public function logout(){
      if(Auth::logout()){
        return redirect()->route('login');
      }
      return redirect()->route('dashboard');
    }
}
