<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 05/08/2016
 * Time: 10:08
 */
use adsproject\Enade;
use adsproject\Http\Requests\EnadeRequest;

/**Classe controller de ENADE
 * Class EnadesController
 * @package adsproject\Http\Controllers
 */
class EnadesController extends Controller
{
    /**Método que redireciona para página inicial de ENADE
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $enades = Enade::all();                             //busca relação de informações de ENADE em ordem de criação
        return view('enades.index', ['enades' => $enades]); //Redireciona para tela inicial de ENADE
    }

    /**Método que redireciona para página de inclusão de nova informação sobre ENADE
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('enades.novo');                         //Redireciona para página de criação de nova informação do ENADE
    }

    /**Método que inclui nova informação sobre ENADE
     * @param EnadeRequest $request informações a serem cadastradas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(EnadeRequest $request)
    {
        Enade::create($request->all());                       //Cria nova informação de ENADE com dados passados
        return redirect()->route('enades');                   //Redireciona para página inicial de ENADE
    }

    /**Método que redireciona para página de edição de informação do ENADE
     * @param $id int identificador da informação a ser alterada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $enade = Enade::find($id);                            //Busca informação ENADE pelo id
        return view('enades.editar', compact('enade'));       //Redireciona para página de edição de informação ENADE
    }

    /**Método que altera informação do ENADE
     * @param EnadeRequest $request informação nova
     * @param $id int identificador da informação a ser alterada
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(EnadeRequest $request, $id)
    {
        Enade::find($id)->update($request->all());           //Busca informação ENADE pelo id e atualiza
        return redirect('enades');                           //Redireciona para página inicial de ENADE
    }

    /**Método que exclui informação do ENADE
     * @param $id int identificação da informação a ser excluída
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Enade::find($id)->delete();                          //Busca informação ENADE pelo id e exclui
        return redirect()->route('avisos');                  //Redireciona para página inicial de ENADE
    }
}