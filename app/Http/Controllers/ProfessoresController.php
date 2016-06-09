<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Professor;
use adsproject\Http\Requests\ProfessorRequest;


class ProfessoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $professores = Professor::all();
        return view('professores.index', ['professores' => $professores]);
    }

    public function novo()
    {
        return view('professores.novo');
    }

    public function salvar(ProfessorRequest $request)
    {
        $this->validate($request, ['matricula' => 'unique:professors,matricula']);
        Professor::create($request->all());
        return redirect()->route('professores');
    }

    public function editar($id)
    {
        $professor = Professor::find($id);
        return view('professores.editar', compact('professor'));
    }

    public function alterar(ProfessorRequest $request, $id)
    {
        $this->validate($request, ['matricula' => 'unique:professors,matricula,'.$id]);
        Professor::find($id)->update($request->all());
        return redirect()->route('professores');
    }

    public function excluir($id)
    {
        Professor::find($id)->delete();
        return redirect()->route('professores');
    }

    //Métodos do Web Service
    //Método que busca todos os professores para o Web Service
    public function buscarTodos()
    {
        return Professor::all();
    }

    //Método que busca professor por id para o Web Service
    public function buscarPorId($id)
    {
        return Professor::find($id);
    }
    /* //Método que cria um novo professor por meio do Web Service
     public function criar(){
         $professor = new Professor();
         $professor->fill(Input::all());
         return $professor->save();
      }
     //Método que modifica dados do professor por meio do Web Service
     public function modificar($id){
         return Professor::find($id)->update(Input::all());
     }
     //Método que remove professor por meio do Web Service
     public function remover($id){
         return Professor::find($id)->delete();
     }*/
}