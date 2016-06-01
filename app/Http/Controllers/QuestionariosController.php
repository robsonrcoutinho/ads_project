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
use Response;

class QuestionariosController extends Controller
{

    public function novo()
    {
        $avaliacao = Avaliacao::aberta()->first();
        $rota = route('avaliacoes');
        if ($avaliacao == null):
            echo "<script>
                alert('Nenhuma avaliação disponível no momento');
                window.location='$rota';
                </script>";
        else:
            return view('questionarios.novo', ['avaliacao' => $avaliacao]);
        endif;
    }

    public function salvar()
    {
        $this->inserir();
        return redirect()->route('avaliacoes');
    }

    //Métodos do Web Service
    //Método que busca avaliação aberta para o Web Service
    public function buscarAberto()
    {
        return Avaliacao::aberta();
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