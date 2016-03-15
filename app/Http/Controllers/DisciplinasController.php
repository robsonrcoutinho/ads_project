<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Http\Requests;
use adsproject\Disciplina;
use adsproject\Http\Requests\DisciplinaRequest;

class DisciplinasController extends Controller{

    public function index(){
        $disciplinas = Disciplina::where('ativa', true)->get();
        return view('disciplinas.index', ['disciplinas'=>$disciplinas]);
    }

    public function novo(){
        return view('disciplinas.novo');
    }
    public function salvar(DisciplinaRequest $request){
        $disciplina = $request->all();
        Disciplina::create($disciplina);

        return redirect('disciplinas');
    }

    public function editar($codigo){
        $disciplina = Disciplina::where('codigo', $codigo)->first();
        return view('disciplinas.editar', compact('disciplina'));
    }
    public function alterar(DisciplinaRequest $request, $codigo){
        Disciplina::where('codigo', $codigo)->update(['nome'=>$request['nome'], 'carga_horaria'=>$request['carga_horaria'], 'ementa'=>$request['ementa']]);
        return redirect()->route('disciplinas');
    }
    public function excluir($codigo){
        Disciplina::where('codigo', $codigo)->update(['ativa'=>false]);
        return redirect()->route('disciplinas');
    }
}