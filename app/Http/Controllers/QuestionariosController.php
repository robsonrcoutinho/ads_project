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

class QuestionariosController extends Controller
{

    public function novo()
    {
        $avaliacao = Avaliacao::aberta();
        //$rota = route('avaliacoes');
        $rota = view('questionarios.novo');
        dd($rota);
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
        $respostas = Input::get('campo_resposta');
        $avaliacao = Input::get('avaliacao_id');
        foreach ($respostas as $pergunta => $resposta):
            $r = new Resposta();
            $r->pergunta_id = $pergunta;
            $r->campo_resposta = $resposta;
            $r->avaliacao_id = $avaliacao;
            $r->save();
        endforeach;
        return redirect()->route('avaliacoes');
    }
}