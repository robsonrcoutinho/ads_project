<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 21/04/2016
 * Time: 11:12
 */
use adsproject\Aviso;
use adsproject\Http\Requests\AvisoRequest;

class AvisosController extends Controller
{

    public function index()
    {
        $this->removerAntigos();
        $avisos = Aviso::all();
        return view('avisos.index', ['avisos' => $avisos]);
    }

    public function novo()
    {
        return view('avisos.novo');
    }

    public function salvar(AvisoRequest $request)
    {
        Aviso::create($request->all());
        return redirect()->route('avisos');
    }

    public function editar($id)
    {
        $aviso = Aviso::find($id);
        return view('avisos.editar', compact('aviso'));
    }

    public function alterar(AvisoRequest $request, $id)
    {
        Aviso::find($id)->update($request->all());
        return redirect('avisos');
    }

    public function excluir($id)
    {
        Aviso::find($id)->delete();
        return redirect()->route('avisos');
    }
    //Métodos do Web Service
    //Método que busca todos os avisos para o Web Service
    public function buscarTodos()
    {
        $this->removerAntigos();
        return Aviso::all();
    }

    //Método que busca aviso por id para o Web Service
    public function buscarPorId($id)
    {
        return Aviso::find($id);
    }

    //Método que remove avisos antigos (mais de sete dias)
    private function removerAntigos()
    {
        $avisos = Aviso::antigos()->lists('id');
        Aviso::destroy($avisos);
    }
}