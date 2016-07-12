<?php

namespace adsproject\Http\Controllers\Api;

use Illuminate\Http\Request;
use adsproject\Http\Requests;
use adsproject\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller {

    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }


    public function authenticate(Request $request)
    {
        // Pegar credenciais do pedido
        $credentials = $request->only('email', 'password');
        try {
            // Tentar verificar as credenciais e criar um token para o usu�rio
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

    // Quando usu�rio desejar sair da aplica��o. Inv�lido o token, obrigando o usu�rio a se autenticar novamente
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        JWTAuth::invalidate($request->input('token'));
    }
}