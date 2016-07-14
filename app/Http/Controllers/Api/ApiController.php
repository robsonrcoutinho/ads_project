<?php

namespace adsproject\Http\Controllers\Api;

use Illuminate\Http\Request;
use adsproject\Aviso;
use adsproject\Documento;
use adsproject\Professor;
use adsproject\Disciplina;
use adsproject\Avaliacao;
use adsproject\Resposta;
use adsproject\Http\Requests;
use adsproject\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{

    protected $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

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

    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        JWTAuth::invalidate($request->input('token'));

        return response()->json(['token_invalidated' => 'token_delete_success'],500);
    }

    /*
     * Retorna todos os avisos
     * */
    public function avisosAll()
    {
     return Aviso::all();
    }

    /*
     * Retorna todos os documentos
     * */
    public function documentosAll()
    {
        return Documento::all();
    }

    /*
    * Retorna todos os professores
    * */
    public function professoresAll()
    {
        return Professor::all();
    }


    /*
    * Retorna todas as disciplinas
    * */
    public function disciplinasAll()
    {
        return Disciplina::all();
    }

    /*
    * Retorna todas as avaliações
    * */
    public function avaliacoesAll()
    {
        return Avaliacao::all();
    }

    //Método que busca avaliação aberta para o Web Service
    public function questionariosAll()
    {
         return Avaliacao::aberta()->first();

    }

    /*
    * Salva todas as respostas dadas pelo usuário remoto
     *
    * */
    public function questionariosSalvar()
    {
       $this->inserir();
        }

        //Método que realiza inserção de respostas de questionário no banco de dados.
        private function inserir()
    {
        $respostas = Input::get('campo_resposta');
        $avaliacao = Input::get('avaliacao_id');
        foreach ($respostas as $pergunta => $resposta):
            $r = new Resposta();
            $r->pergunta_id = $pergunta;
            $r->campo_resposta = $resposta;
            $r->avaliacao_id = $avaliacao;
            $r->save();
        endforeach;
    }
}
