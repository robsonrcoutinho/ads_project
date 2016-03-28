<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 28/03/2016
 * Time: 10:15
 */
use adsproject\Avaliacao;
use adsproject\Http\Requests\AvaliacaoRequest;

class AvaliacoesController extends Controller{
    public function index(){
        $avaliacoes = Avaliacao::all();
        return view('avaliacoes.index', ['avaliacoes'=>$avaliacoes]);
    }

    public function novo(){
        return view('avaliacoes.novo');
    }
    public function salvar(AvaliacaoRequest $request){
        //$this->validate($request, ['id'=> 'unique:avaliacaos']);
        $avaliacao = $request->all();
        Avaliacao::create($avaliacao);
        return redirect('avaliacoes');
    }

    public function editar($id){
        $avaliacao = Avaliacao::find($id);
        return view('avaliacoes.editar', compact('avaliacao'));
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
