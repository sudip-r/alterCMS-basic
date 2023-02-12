<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    $this->middleware('guest:business')->except('logout');
    $this->middleware('guest:client')->except('logout');
  }

  /**
   * Login
   * 
   * @param Request $request
   * @return Redirect
   */
  public function alterLogin(Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'password' => 'required|min:6'
    ]);

    $credentials = $request->only('email', 'password');
    $credentials['active'] = 1;

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      $user = Auth::user();
      Auth::logout();

      $credentials['guard'] = $user->guard;

      if(Auth::guard($user->guard)->attempt($credentials))
      {
        $request->session()->regenerate();
      }

      switch($user->guard)
      {
        case 'web': 
          return redirect()->intended('alter-admin');
        case 'business': 
          return redirect()->intended('business');
        case 'client': 
          return redirect()->intended('client');
        case 'staff': 
          return redirect()->intended('staff');
      }
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ]);
  }
}
