<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 23/03/2016
 * Time: 10:16
 */
use adsproject\Semestre;
use adsproject\Http\Requests\SemestreRequest;
use adsproject\Disciplina;

class SemestresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $semestres = Semestre::all();
        return view('semestres.index', ['semestres' => $semestres]);
    }

    public function novo()
    {
        $disciplinas = Disciplina::all();
        return view('semestres.novo', ['disciplinas' => $disciplinas]);
    }

    public function salvar(SemestreRequest $request)
    {
        $this->validate($request, ['codigo' => 'unique:semestres,codigo']);
        $semestre = Semestre::create($request->all());
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $semestre->disciplinas()->sync($disciplinas);
        endif;
        return redirect('semestres');
    }

    public function editar($id)
    {
        $semestre = Semestre::find($id);
        $disciplinas = Disciplina::all();
        return view('semestres.editar', ['semestre' => $semestre, 'disciplinas' => $disciplinas]);
    }

    public function alterar(SemestreRequest $request, $id)
    {
        $this->validate($request, ['codigo' => 'unique:semestres,codigo,' . $id]);
        $semestre = Semestre::find($id);
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $semestre->disciplinas()->sync($disciplinas);
        elseif ($semestre->disciplinas != null && !$semestre->disciplinas->isEmpty()):
            $semestre->disciplinas()->detach($semestre->disciplinas);
        endif;
        $semestre->update($request->all());
        return redirect()->route('semestres');
    }
    /*public function excluir($id){
        Semestre::find($id)->delete();
        return redirect()->route('semestres');
    }*/
}
