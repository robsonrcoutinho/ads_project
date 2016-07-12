<?php


namespace adsproject\Http\Controllers\Auth;

use adsproject\User;
use Validator;
use adsproject\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
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
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
        ]);
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }

    public function postLogin(Request $request)
    {
        $usuario = filter_var($request->input('name'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $request->merge([$usuario => $request->input('name')]);
        if (Auth::attempt($request->only($usuario,'password')))
        {
            return redirect()->intended($this->redirectPath());
        } else {
            $rules = [
                'name' => 'required',
                'password' => 'required'
            ];
            $validador = Validator::make($request->all(), $rules)->setAttributeNames(['name' => 'Usuário']);
            return redirect('auth/login')->withErrors($validador)->withInput()->with('erro_autenticacao', 1);
        }
    }

    /*WS*/
    public function authenticate(Request $request)
    {
        // Pegar credenciais do pedido
        $credentials = $request->only('email', 'password');
        try {
            // Tentar verificar as credenciais e criar um token para o usuário
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // Algo deu errado enquanto tenta codificar o token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // Tudo certo. assim retornar o token
        return response()->json(compact('token'));
    }

    // Quando usuário desejar sair da aplicação. Inválido o token, obrigando o usuário a se autenticar novamente
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }
}