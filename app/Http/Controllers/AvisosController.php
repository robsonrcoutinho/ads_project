<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 21/04/2016
 * Time: 11:12
 */
use adsproject\Aviso;
use adsproject\Http\Requests\AvisoRequest;
use PushNotification;

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
     * @param AvisoRequest $request relaÃ§Ã£o de dados do aviso a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AvisoRequest $request)
    {

        Aviso::create($request->all());                      //Cria novo aviso com dados passados

        $aviso = $request->get('titulo');

        $this->sendNotificationToDevice($aviso);

        return redirect()->route('avisos');                     //Redireciona para pÃ¡gina inicial de avisos
    }

    /**Método que redireciona para página de ediÃ§Ã£o de aviso
     * @param $id int identificador do aviso a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $aviso = Aviso::find($id);                              //Busca aviso pelo id
        return view('avisos.editar', compact('aviso'));         //Redireciona para pÃ¡gina de ediÃ§Ã£o de aviso
    }

    /**Método que realiza alteração de dados de aviso
     * @param AvisoRequest $request relalção de dados do aviso a ser alterado
     * @param $id int identificador do aviso a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(AvisoRequest $request, $id)
    {
        Aviso::find($id)->update($request->all());              //Busca aviso pelo id e atualiza
        $titulo = $request->get('titulo');
        $this->sendNotificationToDevice('Editado:'.$titulo);
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

    public function sendNotificationToDevice($aviso){
        $tokens =\adsproject\User::all()->lists('gcm_token');

        $deviceCollection = PushNotification::DeviceCollection();

        foreach ($tokens as $indice => $token):
            if($token != null){
                $deviceCollection->add(PushNotification::Device($token));
            }
        endforeach;

        PushNotification::app('ads')
            ->to($deviceCollection)
            ->send($aviso);
        return 'ok';
    }
}