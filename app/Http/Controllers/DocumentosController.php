<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 23/03/2016
 * Time: 08:45
 */
use adsproject\Documento;
use adsproject\Http\ManipuladorArquivo;
use adsproject\Http\Requests\DocumentoRequest;

/**Classe controller de documentos
 * Class DocumentosController
 * @package adsproject\Http\Controllers
 */
class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'arquivo']);
    }

    /**Método que redireciona para página inicial de documentos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $documentos = Documento::paginate(config('constantes.paginacao'));  //Busca todos os documentos
        return view('documentos.index', ['documentos' => $documentos]);     //Redireciona à página inicial de documentos
    }

    /**Método que redireciona para página de inclusão de novo documento
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('documentos.novo');                                 //Redireciona à página de inclusão de documento
    }

    /**Método que inclui novo documento no sistema
     * @param DocumentoRequest $request relação de dados do documento a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(DocumentoRequest $request)
    {
        $this->validate($request, ['arquivo' => 'required']);           //Realiza validação de arquivo
        $documento = new Documento($request->all());                    //Cria novo documento com dados passados
        $nomeArquivo = $documento->titulo;                              //Define o nome do arquivo como o título do documento
        /*Passa arquivo de documento, nome da paste onde deve ser salvo e nome do arquivo
         recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $documento->url = ManipuladorArquivo::salvar($request->file('arquivo'), 'documento', $nomeArquivo);
        $documento->save();                                             //Salva documento
        return redirect()->route('documentos');                         //Redireciona à página inicial de documentos
    }

    /**Método que redireciona para página de edição de documento
     * @param $id int identificador do documento a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $documento = Documento::find($id);                          //Busca documento pelo id
        return view('documentos.editar', compact('documento'));     //Redireciona à página de edição de documento
    }

    /**Método que realiza alteração de dados de documento
     * @param DocumentoRequest $request relação de dados do documento a ser alterado
     * @param $id int identificador do documento a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(DocumentoRequest $request, $id)
    {
        $documento = Documento::find($id);                          //Busca documento por id
        $nomeArquivo = $documento->titulo;                          //Define o nome do arquivo como o título do documento
        /*Passa arquivo de documento, nome da paste onde deve ser salvo e nome do arquivo
         recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $url = ManipuladorArquivo::salvar($request->file('arquivo'), 'documento', $nomeArquivo);
        //Verifica se caminho do documento não está nulo e se é diferente do salvo no banco de dados
        if ($url != null && $url != $documento->url):
            ManipuladorArquivo::excluir($documento->url);           //Solicita exclusão do arquivo antigo
            $documento->url = $url;                                 //Passa novo caminho para documento
        endif;
        $documento->update($request->all());                        //Salva alterações
        return redirect('documentos');                              //Redireciona à página inicial de documentos
    }

    /**Método que exclui documento
     * @param $id int identificador do documento a ser excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Documento::find($id)->delete();                         //Busca documentos por id e exclui
        return redirect()->route('documentos');                 //Redireciona à página inicial de documentos
    }

    /**Método que abre ou baixa arquivo de doumento
     * @param $id int identificador do documento
     */
    public function arquivo($id)
    {
        $documento = Documento::find($id);                         //Busca documento pelo id
        return ManipuladorArquivo::abrir($documento->url);         //Usa o manipulador de arquivo para abrir ou baixar
    }
    //Métodos do Web Service
    //Método que busca todos os documentos para o Web Service
    public function buscarTodos()
    {
        return Documento::all();
    }

    //Método que busca documento por id para o Web Service
    public function buscarPorId($id)
    {
        return Documento::find($id);
    }

    public function buscarPorTitulo($titulo)
    {
        $documentos = Documento::where('titulo', $titulo)->get();
        return $documentos;
    }
}