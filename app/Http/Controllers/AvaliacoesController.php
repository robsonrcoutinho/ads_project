<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 28/03/2016
 * Time: 10:15
 */
use adsproject\Avaliacao;
use adsproject\Http\Requests\AvaliacaoRequest;
use adsproject\Semestre;

class AvaliacoesController extends Controller{
    public function index(){
        $avaliacoes = Avaliacao::all();
        return view('avaliacoes.index', ['avaliacoes'=>$avaliacoes]);
    }

    public function novo(){
        $semestres = Semestre::all()->lists('codigo','codigo');
        return view('avaliacoes.novo',['semestres'=>$semestres]);
    }
    public function salvar(AvaliacaoRequest $request){
        //$this->validate($request, ['id'=> 'unique:avaliacaos']);
        $avaliacao = $request->all();
        Avaliacao::create($avaliacao);
        return redirect('avaliacoes');
    }

    public function editar($id){
        $avaliacao = Avaliacao::find($id);
        $semestres = Semestre::all()->lists('codigo','codigo');
        return view('avaliacoes.editar', compact('avaliacao', 'semestres'));
    }
    public function alterar(AvaliacaoRequest $request, $id){
        Avaliacao::find($id)->update($request->all());
        return redirect()->route('avaliacoes');
    }
    public function excluir($id){
        Avaliacao::find($id)->delete();
        return redirect()->route('avaliacoes');
    }
}
