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
        $credentials = $request->only('name', 'password');

        try {
            // Verificar as credenciais e criar um token para o usuário
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->error(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // algo deu errado enquanto tenta codificar o token
            return response()->error(['error' => 'could_not_create_token'], 500);
        }

        // Tudo ok. Retornar o token
        return $this->response()->array(compact('token'))->setStatusCode(200);
    }


    /**
     * Log out
     * Invalida o token , assim o usuário não pode usá-lo mais
     * Eles têm que fazer login para obter um novo token
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