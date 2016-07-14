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
use Illuminate\Support\Facades\Input;
use \Auth;


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
            $this->mensagem('Para acessa essa página usuário precisa ser aluno', route('avaliacoes'));
        endif;
        $avaliacao = Avaliacao::aberta()->first();
        if ($avaliacao == null):
            $this->mensagem('Nenhuma avaliação disponível no momento', '/');
        else:
            return view('questionarios.novo', ['avaliacao' => $avaliacao]);
        endif;
    }

    public function salvar()
    {
        $this->inserir();
        return redirect()->route('avaliacoes');
    }

    private function mensagem($texto, $rota)
    {
        echo "<script>
                alert('$texto');
                window.location='$rota';
                </script>";
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

    //Método que realiza inserção de respostas de questionário
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