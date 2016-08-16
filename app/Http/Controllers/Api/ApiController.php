<?php

namespace adsproject\Http\Controllers\Api;

use Illuminate\Http\Request;
use adsproject\Aviso;
use adsproject\Aluno;
use adsproject\Documento;
use adsproject\Professor;
use adsproject\User;
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

    /*
    public function __construct(JWTAuth $auth)
    {
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }*/

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

    public function logout(Request $request)
    {
        $this->validate($request, ['token' => 'required']);
        JWTAuth::invalidate($request->input('token'));

        return response()->json(['token_invalidated' => 'token_delete_success'], 500);
    }

    /*
     * Retorna todos os avisos
     * */
    public function avisosAll()
    {
        return response()
            ->json(Aviso::all());
    }

    /*
     * Retorna todos os documentos
     * */
    public function documentosAll()
    {
        return response()
            ->json(Documento::all());
    }

    /*
    * Retorna todos os professores
    * */
    public function professoresAll()
    {
        return response()
            ->json(Professor::all());
    }


    /*
    * Retorna todas as disciplinas
    * */
    public function disciplinasAll()
    {
        return response()
            ->json(Disciplina::all());
    }

    /*
    * Retorna todas as avaliações
    * */
    public function avaliacoesAll()
    {
        return response()
            ->json(Avaliacao::all());
    }

    //Método que busca avaliação aberta para o Web Service
    public function questionariosAll()
    {
        return response()
            ->json(Avaliacao::aberta()->first());
    }

    /*
    * Salva todas as respostas dadas pelo usu�rio remoto
     *
    * */
    public function questionariosSalvar()
    {
        $this->inserir();
    }

    //Método que realiza insersão de respostas de questionário no banco de dados.
    private function inserir()
    {
        $respostas = \Input::get('campo_resposta');
        $avaliacao = \Input::get('avaliacao_id');
        foreach ($respostas as $pergunta => $resposta):
            $r = new Resposta();
            $r->pergunta_id = $pergunta;
            $r->campo_resposta = $resposta;
            $r->avaliacao_id = $avaliacao;
            $r->save();
        endforeach;
    }

    public function buscaDisciplinasCursadas(Request $request)
    {
        $email = $request->input('email');
        $aluno = Aluno::query()->where('email', $email)->first();
        if ($aluno == null):
            return response()->json(['avaliacao' => 'nao_aluno']);
        endif;
        $avaliacao = Avaliacao::aberta()->first();
        if ($avaliacao == null):
            return response()->json(['avaliacao' => 'sem_avaliacao']);
        endif;
        if ($aluno->avaliacoes()->get()->contains($avaliacao)):
            return response()->json(['avaliacao' => 'feita']);
        endif;
        return response()->json($aluno->disciplinas()->get());
    }

    public function informacaoUser(Request $request)
    {
        $email = $request->input('email');
        $user = User::query()->where('email', $email)->first();
        if ($user == null):
            return response()->json(['user' => 'nulo']);
        endif;
        if ($user->role == 'aluno'):
            $aluno = Aluno::query()->where('email', $email)->lists('matricula');
            return response()->json(['aluno' => $user, 'matricula' => $aluno]);
        endif;
        if ($user->role == 'professor'):
            //$professor = Professor::query()->where('email', $email)->lists('nome', 'matricula');
            return response()->json(['professor' => $user]);
        endif;
        return response()->json(['admin' => $user]);
    }

    public function respostaQuestionario(Request $request)
    {
        $respostas = json_decode($request->get('respostas'), true);
        $email = $request->get('email');
        $avaliacao = null;
        foreach($respostas as $resposta):
            $r = new Resposta();
            $r->pergunta_id = $resposta['id_resposta'];
            $r->campo_resposta = $resposta['campo_resposta'];
            $r->avaliacao_id = $resposta['id_avaliacao'];
            $avaliacao = $resposta['id_avaliacao'];
            $r->disciplina_id = $resposta['id_disciplina'];
            dd($r->all());
            $r->save();
        endforeach;
        $aluno = Aluno::query()->where('email', $email)->first();
        $aluno->avaliacoes()->attach($avaliacao);
    }
}