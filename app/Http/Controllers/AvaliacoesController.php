<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 06/04/2016
 * Time: 09:22
 */
use adsproject\Avaliacao;
use adsproject\Http\Requests\AvaliacaoRequest;
use adsproject\Semestre;
use adsproject\Pergunta;


class AvaliacoesController extends Controller
{

    public function index()
    {
        $avaliacoes = Avaliacao::all();
        return view('avaliacoes.index', ['avaliacoes' => $avaliacoes]);
    }

    public function novo()
    {
        $semestres = Semestre::all()->lists('codigo', 'id');
        $perguntas = Pergunta::all();
        return view('avaliacoes.novo', compact('semestres', 'perguntas'));
    }

    public function salvar(AvaliacaoRequest $request)
    {
        dd($request->all());
        $avaliacao = Avaliacao::create($request->all());
        $perguntas = $request->get('perguntas');
        if ($perguntas != null):
            $avaliacao->perguntas()->sync($perguntas);
        endif;
        return redirect()->route('avaliacoes');
    }

    public function editar($id)
    {
        $avaliacao = Avaliacao::find($id);
        $semestres = Semestre::all()->lists('codigo', 'id');
        $perguntas = Pergunta::all();
        return view('avaliacoes.editar', compact('avaliacao', 'semestres', 'perguntas'));
    }

    public function alterar(AvaliacaoRequest $request, $id)
    {
        $avaliacao = Avaliacao::find($id);
        $perguntas = $request->get('perguntas');
        if ($perguntas != null):
            $avaliacao->perguntas()->sync($perguntas);
        elseif ($avaliacao->perguntas != null):
            $avaliacao->perguntas()->detach();
        endif;
        $avaliacao->update($request->all());
        return redirect()->route('avaliacoes');
    }

    public function excluir($id)
    {
        Avaliacao::find($id)->delete();
        return redirect()->route('avaliacoes');
    }

    //Metodos do Web Service
    //Metodo que busca todos as avaliacoes para o Web Service
    public function buscarTodos()
    {
        return Avaliacao::all();
    }

    //Metodo que busca avaliacao por id para o Web Service
    public function buscarPorId($id)
    {
        return Avaliacao::find($id);
    }
}