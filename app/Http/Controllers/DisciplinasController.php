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
        $disciplinas = Disciplina::all();
        return view('disciplinas.novo', ['disciplinas'=>$disciplinas]);
    }
    public function salvar(DisciplinaRequest $request){
        $disciplina = Disciplina::create($request->all());
        $pre_requisitos = $request->get('pre_requisitos');
        if($pre_requisitos!=null):
           $disciplina->pre_requisitos()->sync($pre_requisitos);
            $disciplina->update();
        endif;
        return redirect('disciplinas');
    }
    public function editar($id){
        $disciplina = Disciplina::find($id);
        $disciplinas = Disciplina::all();
        return view('disciplinas.editar', ['disciplina'=>$disciplina,'disciplinas'=>$disciplinas]);
    }
    public function alterar(DisciplinaRequest $request, $id){
        $disciplina=Disciplina::find($id);
        $pre_requisitos = $request->get('pre_requisitos');
        if($pre_requisitos!=null):
            $disciplina->pre_requisitos()->sync($pre_requisitos);
        elseif($disciplina->pre_requisitos!=null):
            $disciplina->pre_requisitos()->detach($disciplina->pre_requsitos);
        endif;
        $disciplina->update($request->all());
        return redirect()->route('disciplinas');
    }
    public function excluir($id){
        Disciplina::find($id)->delete();
        return redirect()->route('disciplinas');
    }
}