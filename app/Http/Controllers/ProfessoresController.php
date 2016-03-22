<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Professor;
use adsproject\Http\Requests\ProfessorRequest;


class ProfessoresController extends Controller{

    public function index(){
        $professores = Professor::where('ativo', true)->get();
        return view('professores.index', ['professores'=>$professores]);
    }

    public function novo(){
        return view('professores.novo');
    }
    public function salvar(ProfessorRequest $request){
        //Incluir validação de matrícula
        $this->validate($request, ['matricula'=> 'unique:professors']);
        $professor = $request->all();
        Professor::create($professor);
        return redirect()->route('professores');

    }

    public function editar($matricula){
        $professor = Professor::where('matricula', $matricula)->first();
        return view('professores.editar', compact('professor'));
    }
    public function alterar(ProfessorRequest $request, $matricula){
        Professor::where('matricula', $matricula)->update(['nome'=>$request['nome'], 'curriculo'=>$request['curriculo']]);
        return redirect()->route('professores');
    }
    public function excluir($matricula){
        Professor::where('matricula', $matricula)->update(['ativo'=>false]);
        return redirect()->route('professores');
    }
}