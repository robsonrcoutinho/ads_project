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

class SemestresController extends Controller{
    public function index(){
        $semestres = Semestre::all();
        return view('semestres.index', ['semestres'=>$semestres]);
    }

    public function novo(){
        $disciplinas = Disciplina::all();
        return view('semestres.novo', ['disciplinas'=>$disciplinas]);
    }
    public function salvar(SemestreRequest $request){
        $semestre=Semestre::create($request->all());
        $disciplinas = $request->get('disciplinas');
        if($disciplinas!=null):
            $semestre->disciplinas()->sync($disciplinas);
            $semestre->update();
        endif;
        return redirect('semestres');
    }

    public function editar($id){
        $semestre = Semestre::find($id);
        $disciplinas = Disciplina::all();
        return view('semestres.editar',['semestre'=>$semestre,'disciplinas'=>$disciplinas]);
    }
    public function alterar(SemestreRequest $request, $id){
        $semestre=Semestre::find($id);
        $disciplinas = $request->get('disciplinas');
        if($disciplinas!=null):
            $semestre->disciplinas()->sync($disciplinas);
        elseif($semestre->disciplinas != null):
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
