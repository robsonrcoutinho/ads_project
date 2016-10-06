<?php

namespace adsproject\Http\Controllers\Auth;

use adsproject\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Auth;
use DB;

class PasswordController extends Controller
{
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
    protected $redirectoTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
        Auth::login($user);
    }

    public function getReset($token)
    {
        $email = DB::select(
            'select email from password_resets where token = :token',
            ['token' => $token])[0]->email;
        return view('auth.reset', ['token' => $token, 'email' => $email]);
    }
}