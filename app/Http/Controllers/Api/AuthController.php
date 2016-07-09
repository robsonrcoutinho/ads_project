<?php

namespace adsproject\Http\Controllers\Api;

use Illuminate\Http\Request;
use adsproject\Http\Requests;
use adsproject\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller {

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            // Verificar as credenciais e criar um token para o usu�rio
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // algo deu errado enquanto tenta codificar o token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // Tudo ok. Retornar o token
        return response()->json(compact('token'));
    }


    /**
     * Log out
     * Invalida o token , assim o usu�rio n�o pode us�-lo mais
     * Eles t�m que fazer login para obter um novo token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        JWTAuth::invalidate($request->input('token'));
    }
}