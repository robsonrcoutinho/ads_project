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
        $professores = Professor::all();
        return view('professores.index', ['professores'=>$professores]);
    }

    public function novo(){
        return view('professores.novo');
    }
    public function salvar(ProfessorRequest $request){
        //Incluir validação de matrícula
        //$this->validate($request, ['matricula'=> 'unique:professors']);
        $professor = $request->all();
        Professor::create($professor);
        return redirect()->route('professores');
    }
    public function editar($id){
        $professor = Professor::find($id);
        return view('professores.editar', compact('professor'));
    }
    public function alterar(ProfessorRequest $request, $id){
        Professor::find($id)->update($request->all());
        return redirect()->route('professores');
    }
    public function excluir($id){
        Professor::find($id)->delete();
        return redirect()->route('professores');
    }
}