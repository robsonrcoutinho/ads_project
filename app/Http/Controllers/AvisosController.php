<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 21/04/2016
 * Time: 11:12
 */
use adsproject\Aviso;
use adsproject\Http\Requests\AvisoRequest;

/**Classe controller de avisos
 * Class AvisosController
 * @package adsproject\Http\Controllers
 */
class AvisosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de avisos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->removerAntigos();                                    //Evoca método para remover avisos antigos
        $avisos = Aviso::orderBy('id', 'desc')
            ->paginate(config('constantes.paginacao'));             //Busca todos os avisos ordenando por id de forma decrescente
        return view('avisos.index', ['avisos' => $avisos]);         //Redireciona para página inicial de avisos
    }

    /**Método que redireciona para página de inclusão de novo aviso
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('avisos.novo');                             //Redireciona para página de criação de novo aviso
    }

    /**Método que inclui novo aviso no sistema
     * @param AvisoRequest $request relação de dados do aviso a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AvisoRequest $request)
    {
        // $deviceToken = 'eMVP__sUxwM:APA91bEKtlA64h9dSceW7cY_xbAudJaawJp5z1ReTpD_zGCohtv2TtZtCG_UnMAQ4bCNblsVUeLcorF2ROSY713vqaoYxF2XHDuWJKNkJcSP-tk8PxfwFqBG7vyifBWNyN1mL34k4q4z';
        Aviso::create($request->all());                         //Cria novo aviso com dados passados

        /*PushNotification::app('ADSNotify')
            ->to($deviceToken)
            ->send('Test push');*/

        return redirect()->route('avisos');                     //Redireciona para página inicial de avisos
    }

    /**Método que redireciona para página de edição de aviso
     * @param $id int identificador do aviso a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $aviso = Aviso::find($id);                              //Busca aviso pelo id
        return view('avisos.editar', compact('aviso'));         //Redireciona para página de edição de aviso
    }

    /**Método que realiza alteração de dados de aviso
     * @param AvisoRequest $request relação de dados do aviso a ser alterado
     * @param $id int identificador do aviso a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(AvisoRequest $request, $id)
    {
        Aviso::find($id)->update($request->all());              //Busca aviso pelo id e atualiza
        return redirect('avisos');                              //Redireciona para página inicial de avisos
    }

    /**Método que exclui aviso
     * @param $id int identificador do aviso a ser excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Aviso::find($id)->delete();                             //Busca aviso pelo id e exclui
        return redirect()->route('avisos');                     //Redireciona para página inicial de avisos
    }

    /**
     *Método que remove avisos antigos (mais de sete dias)
     */
    private function removerAntigos()
    {
        $avisos = Aviso::antigos()->lists('id');                //Busca avisos antigos e pega id
        Aviso::destroy($avisos->all());                         //Apaga avisos antigos
    }
}