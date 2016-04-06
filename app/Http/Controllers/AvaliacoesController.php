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
        return view('avaliacoes.index', ['disciplinas'=>$avaliacoes]);
    }

    public function novo(){
        $semestres = Semestre::all()->get('id','codigo');
        return view('avaliacoes.novo', compact('semestres'));
    }
    public function salvar(AvaliacaoRequest $request){
        $avaliacao = $request->all();
        Disciplina::create($avaliacao);

        return redirect('avaliacoes');
    }
    public function editar($id){
        $avaliacao = Avaliacao::find($id);
        $semestres=Semestre::all();
        return view('avaliacoes.editar', compact('avaliacao', 'semestres'));
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