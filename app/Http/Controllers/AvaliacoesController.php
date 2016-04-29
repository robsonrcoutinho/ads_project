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
        return view('avaliacoes.index', ['avaliacoes'=>$avaliacoes]);
    }

    public function novo(){
        $semestres = Semestre::all()->lists('codigo','id');
        return view('avaliacoes.novo', compact('semestres'));
    }
    public function salvar(AvaliacaoRequest $request){
        $avaliacao = $request->all();
        Avaliacao::create($avaliacao);
        return redirect('avaliacoes');
    }
    public function editar($id){
        $avaliacao = Avaliacao::find($id);
        $semestres=Semestre::all()->lists('codigo', 'id');
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

    //Métodos do Web Service
    //Método que busca todos as avaliações para o Web Service
    public function buscarTodos(){
        return Avaliacao::all();
    }
    //Método que busca avaliacao por id para o Web Service
    public function buscarPorId($id){
        return Avaliacao::find($id);
    }
}