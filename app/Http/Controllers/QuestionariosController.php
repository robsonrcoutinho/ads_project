<?php

namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 24/05/2016
 * Time: 10:09
 */
use adsproject\Avaliacao;
use adsproject\Resposta;
use adsproject\Aluno;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;


class QuestionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function novo()
    {
        $user = Auth::getUser();
        if ($user->role != 'aluno'):
            $rota = $user->role == 'admin' ? route('avaliacoes') : '/';
            $this->mensagem('Para acessa essa página usuário precisa ser aluno.', $rota);
        endif;
        $avaliacao = Avaliacao::aberta()->first();
        if ($avaliacao == null):
            $this->mensagem('Nenhuma avaliação disponível no momento', '/');
        endif;
        if ($user->avaliacoes()->get()->contains($avaliacao)):
            $this->mensagem('Usuário já realizou última avaliação.', '/');
        endif;
        $aluno = Aluno::query()->where('nome', $user->name)->where('email', $user->email)->first();
        if ($aluno == null || $aluno->disciplinas()->get()->isEmpty()):
            $this->mensagem('Aluno impossibilitado de realizar avaliação.', '/');
        endif;
        return view('questionarios.novo', compact('avaliacao', 'aluno'));
    }

    public function salvar()
    {
        $input = Input::all();
        $indices = collect($input['pergunta_id'])->keys();
        $rules = array();
        $respostas = $input["campo_resposta"];
        foreach ($indices as $indice):
            $rules[$indice] = 'required';
        endforeach;
        $mensagens = ['required' => 'Existem respostas não informadas.'];
        $validador = Validator::make($respostas, $rules, $mensagens);
        if ($validador->fails()):
            return redirect()->back()->withInput()->withErrors($validador);
        endif;
        $this->inserir();
        return redirect('/');
    }

    private function mensagem($texto, $rota)
    {
        echo "<script>
                alert('$texto');
                window.location='$rota';
                </script>";
    }

    //Método que realiza inserção de respostas de questionário
    private function inserir()
    {
        $user = Auth::getUser();
        $respostas = Input::get('campo_resposta');
        $avaliacao = Input::get('avaliacao_id');
        $disciplinas = Input::get('disciplina_id');
        $perguntas = Input::get('pergunta_id');

        foreach ($respostas as $indice => $resposta):
            $r = new Resposta();
            $r->pergunta_id = $perguntas[$indice];
            $r->campo_resposta = $resposta;
            $r->avaliacao_id = $avaliacao;
            $r->disciplina_id = $disciplinas[$indice];
            $r->save();
        endforeach;
        $user->avaliacoes()->attach($avaliacao);
    }
    //Métodos do Web Service
    //Método que busca avaliação aberta para o Web Service
    public function buscarAberto()
    {
        return Avaliacao::aberta()->first();
    }

    //Método que salva respostas de questionário via Web Service
    public function salvarRespostas()
    {
        $this->inserir();
    }
}