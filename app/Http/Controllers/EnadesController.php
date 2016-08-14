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
    /**M�todo que redireciona para p�gina inicial de ENADE
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $enades = Enade::all();                             //busca rela��o de informa��es de ENADE em ordem de cria��o
        return view('enades.index', ['enades' => $enades]); //Redireciona para tela inicial de ENADE
    }

    /**M�todo que redireciona para p�gina de inclus�o de nova informa��o sobre ENADE
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('enades.novo');                         //Redireciona para p�gina de cria��o de nova informa��o do ENADE
    }

    /**M�todo que inclui nova informa��o sobre ENADE
     * @param EnadeRequest $request informa��es a serem cadastradas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(EnadeRequest $request)
    {
        Enade::create($request->all());                       //Cria nova informa��o de ENADE com dados passados
        return redirect()->route('enades');                   //Redireciona para p�gina inicial de ENADE
    }

    /**M�todo que redireciona para p�gina de edi��o de informa��o do ENADE
     * @param $id int identificador da informa��o a ser alterada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $enade = Enade::find($id);                            //Busca informa��o ENADE pelo id
        return view('enades.editar', compact('enade'));       //Redireciona para p�gina de edi��o de informa��o ENADE
    }

    /**M�todo que altera informa��o do ENADE
     * @param EnadeRequest $request informa��o nova
     * @param $id int identificador da informa��o a ser alterada
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(EnadeRequest $request, $id)
    {
        Enade::find($id)->update($request->all());           //Busca informa��o ENADE pelo id e atualiza
        return redirect('enades');                           //Redireciona para p�gina inicial de ENADE
    }

    /**M�todo que exclui informa��o do ENADE
     * @param $id int identifica��o da informa��o a ser exclu�da
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Enade::find($id)->delete();                          //Busca informa��o ENADE pelo id e exclui
        return redirect()->route('avisos');                  //Redireciona para p�gina inicial de ENADE
    }
}