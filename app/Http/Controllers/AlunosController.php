<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;


class AlunosController extends Controller{

    public function index(){
        $alunos = Aluno::all();
        return view('alunos.index', ['alunos'=>$alunos]);
    }
     public function novo(){
        return view('alunos.novo');
    }

    public function salvar(AlunoRequest $request){
        Aluno::create($request->all());
        return redirect()->route('alunos');
    }
    public function editar($id){
        $aluno = Aluno::find($id);
        return view('alunos.editar', compact('aluno'));
    }
    public function alterar(AlunoRequest $request, $id){
        Aluno::find($id)->update($request->all());
        return redirect()->route('alunos');
    }
    public function excluir($id){
        Aluno::find($id)->delete();
        return redirect()->route('alunos');
    }

    public function buscarTodos(){
        return Aluno::all();
    }
    
    public function buscarPorId($id){
        return Aluno::find($id);
    }

}