<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 06/04/2016
 * Time: 09:22
 */
use adsproject\Avaliacao;
use adsproject\Http\Requests\AvaliacaoRequest;
use adsproject\Semestre;


class AvaliacoesController extends Controller{

    public function index(){
        $avaliacoes = Avaliacao::all();
        $semestres = Semestre::all()->get('id','codigo');
        return view('avaliacoes.index', ['disciplinas'=>$avaliacoes, 'semestres'=>$semestres]);
    }

    public function novo(){
        return view('avaliacoes.novo');
    }
    public function salvar(AvaliacaoRequest $request){
        $avaliacao = $request->all();
        Disciplina::create($avaliacao);

        return redirect('avaliacoes');
    }
    public function editar($id){
        $avaliacao = Avaliacao::find($id);
        return view('avaliacoes.editar', compact('avaliacao'));
    }
    public function alterar(AvaliacaoRequest $request, $id){
        Avaliacao::find($id)->update($request);
        return redirect()->route('avaliacoes');
    }
    public function excluir($id){
        Avaliacao::find($id)->delete();
        return redirect()->route('avaliacoes');
    }
}