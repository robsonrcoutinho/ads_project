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

    /**Método que redireciona para página inicial de respostas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $respostas = Resposta::all();                                   //Busca todas as respostas
        return view('respostas.index', ['respostas' => $respostas]);    //Redireciona à página inicial de respostas
    }
}