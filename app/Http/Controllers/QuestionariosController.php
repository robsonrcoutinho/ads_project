<?php

namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 24/05/2016
 * Time: 10:09
 */
use adsproject\Avaliacao;

use Illuminate\Support\Facades\Input;

class QuestionariosController extends Controller
{

    public function novo()
    {
        $avaliacao = Avaliacao::whereDate('inicio', '<=', date('Y-m-d'))->whereDate('termino', '>=', date('Y-m-d'))->get()->first();
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
    public function salvar(){
        dd(Input::get('campo_resposta'));
    }
}