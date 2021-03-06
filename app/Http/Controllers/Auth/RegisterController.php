<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $errorMessage = [
            'user_name.required' => 'Nama Diperlukan',
            'user_name.max' => 'Panjang Maximum Nama adalah 255 karakter',
            'email.required' => 'Email Diperlukan',
            'email.email' => 'Email harus menggunakan format email yang benar',
            'email.max' => 'Panjang Maximum Email adalah 255 karakter',
            'email.unique' => 'Email anda sudah digunakan akun lain',
            'password.required' => 'Password Diperlukan',
            'password.min' => 'Panjang Minimum Password adalah 6 karakter',
            'password.max' => 'Panjang Maximum Password adalah 255 karakter',
            'password.confirmed' => 'Konfirmasi Password harus sama dengan Password',

        ];

        return Validator::make($data, [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ], $errorMessage);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_role' => $data['user_role'],
        ]);
    }
}
