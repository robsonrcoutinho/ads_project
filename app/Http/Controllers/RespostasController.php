<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 25/05/2016
 * Time: 09:25
 */
use adsproject\Resposta;

/**Classe controller de respostas
 * Class RespostasController
 * @package adsproject\Http\Controllers
 */
class RespostasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**M�todo que redireciona para p�gina inicial de respostas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $respostas = Resposta::paginate(config('constantes.paginacao'));            //Busca todas as respostas
        return view('respostas.index', ['respostas' => $respostas]);                //Redireciona � p�gina inicial de respostas
    }

    /**M�todo que retorna lista com respostas a partir de dados passados
     * @param $avaliacao_id int identificador da avalia��o
     * @param $pergunta_id int identificador da pergunta
     * @param $disciplina_id int identificador da disciplina
     * @return mixed respostas da pergunta especificada
     */
    public static function buscarEspecificas($avaliacao_id, $pergunta_id, $disciplina_id)
    {
        //Busca respostas com os dados especificados, passando id da avalia��o, da pergunta e da disciplina
        return Resposta::especificas($avaliacao_id, $pergunta_id, $disciplina_id);
    }
}