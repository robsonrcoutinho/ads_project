<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 23/03/2016
 * Time: 10:16
 */
use adsproject\Semestre;
use adsproject\Http\Requests\SemestreRequest;

class SemestresController extends Controller{
    public function index(){
        $semestres = Semestre::all();
        return view('semestres.index', ['semestres'=>$semestres]);
    }

    public function novo(){
        return view('semestres.novo');
    }
    public function salvar(SemestreRequest $request){
        $this->validate($request, ['codigo'=> 'unique:semestres']);
        $semestre = $request->all();
        Semestre::create($semestre);
        return redirect('semestres');
    }

    public function editar($codigo){
        $semestre = Semestre::where('codigo', $codigo)->first();
        return view('semestres.editar', compact('semestre'));
    }
    public function alterar(SemestreRequest $request, $codigo){
        Semestre::where('codigo', $codigo)->update(['inicio'=>$request['inicio'], 'termino'=>$request['termino']]);
        return redirect()->route('semestres');
    }
    /*public function excluir($codigo){
        Semestre::where('codigo', $codigo)->update(['ativa'=>false]);
        return redirect()->route('semestres');
    }*/
}
