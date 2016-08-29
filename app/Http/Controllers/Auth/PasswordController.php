<?php

namespace adsproject\Http\Controllers\Auth;

use adsproject\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    protected $redirectTo = '/';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */

    protected $redirectoTo='/';
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function resetPassword($user,$password)
    {

        if (Hash::check('plain-text', $password)) {

            $user->password = $password;

            $user->save();

            auth::login($user);
        }
    }
}