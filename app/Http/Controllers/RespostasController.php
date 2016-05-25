<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 25/05/2016
 * Time: 09:25
 */
use adsproject\Resposta;

class RespostasController extends Controller
{
    public function index()
    {
        $respostas = Resposta::all();
        return view('respostas.index', ['respostas' => $respostas]);
    }
}