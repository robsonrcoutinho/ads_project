<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Disciplina;
use adsproject\Http\Requests\DisciplinaRequest;

class DisciplinasController extends Controller{

    public function index(){
        $disciplinas = Disciplina::all();
        return view('disciplinas.index', ['disciplinas'=>$disciplinas]);
    }
    public function novo(){
        return view('disciplinas.novo');
    }
    public function salvar(DisciplinaRequest $request){
        //$this->validate($request, ['codigo'=> 'unique:disciplinas']);
        $disciplina = $request->all();
        Disciplina::create($disciplina);
        return redirect('disciplinas');
    }
    public function editar($id){
        $disciplina = Disciplina::find($id);
        return view('disciplinas.editar', compact('disciplina'));
    }
    public function alterar(DisciplinaRequest $request, $id){

        Disciplina::find($id)->update($request->all());
        return redirect()->route('disciplinas');
    }
    public function excluir($id){
        Disciplina::find($id)->delete();
        return redirect()->route('disciplinas');
    }
}