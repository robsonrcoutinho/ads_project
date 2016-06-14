<?php

namespace adsproject\Http\Controllers\Auth;

use adsproject\User;
use Validator;
use adsproject\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $papel = $data['role'];
        if ($papel == 'professor'):
            $role = 'required|max:255|exists:professors,nome';
        elseif ($papel == 'aluno'):
            $role = 'required|max:255|exists:alunos,nome';
        endif;
        return Validator::make($data, [
            'name' => $role,
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(
            [
                'name' => $request->name,
                'password' => $request->password,
            ], $request->has
        )
        ) {
            return redirect()->intended($this->redirectPath());
        } else {
            $rules = [
                'name' => 'required',
                'password' => 'required'
            ];
            $validador = Validator::make($request->all(), $rules)->setAttributeNames(['name' => 'Usuário']);
            return redirect('auth/login')->withErrors($validador)->withInput()->with('erro_autenticacao',1);
        }
    }
}
