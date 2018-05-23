<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validateLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:255',
        ], [
            'email.required' => 'Email Dibutuhkan',
            'email.email' => 'Email harus menggunakan format email yang benar',
            'email.max' => 'Panjang Maximum Email adalah 255 karakter',
            'password.required' => 'Password Dibutuhkan',
            'password.min' => 'Panjang Minimum Password adalah 6 Karakter',
            'password.max' => 'Panjang Maximum Password adalah 255 karakter',
        ]);
    }
}
