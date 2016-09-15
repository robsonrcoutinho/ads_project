<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Disciplina;
use adsproject\Http\Requests\DisciplinaRequest;
use adsproject\Professor;
use adsproject\Http\ManipuladorArquivo;

/**Classe controller de disciplinas
 * Class DisciplinasController
 * @package adsproject\Http\Controllers
 */
class DisciplinasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de disciplinas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $disciplinas = Disciplina::orderBy('nome')
            ->paginate(config('constantes.paginacao'));                     //Busca disciplinas em ordem alfabética e pagina
        return view('disciplinas.index', ['disciplinas' => $disciplinas]);  //Redireciona à página inicial de disciplinas
    }

    /**Método que redireciona para página de inclusão de nova disciplina
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();                  //Busca disciplinas em ordem alfabética
        $professores = Professor::orderBy('nome')->get();                   //Busca professores em ordem alfabética
        return view('disciplinas.novo', [
            'disciplinas' => $disciplinas,
            'professores' => $professores
        ]);                                                                 //Redireciona para página de inclusão de disciplina
    }

    /**Método que inclui nova disciplina no sistema
     * @param DisciplinaRequest $request relação de dados da disciplina a ser inserido
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salvar(DisciplinaRequest $request)
    {
        $this->validate($request,
            ['codigo' => 'unique:disciplinas,codigo']);                 //Valida código da disciplina
        $disciplina = new Disciplina($request->all());                  //Cria nova disciplina
        $nomeArquivo = 'ementa_' . $disciplina->codigo;                 //Define nome do arquivo de ementa
        /*Passa arquivo de ementa, nome da pasta onde deve ser salvo e nome do arquivo
        recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $ementa = ManipuladorArquivo::salvar($request->file('ementa'), 'ementa', $nomeArquivo);
        $nomeArquivo = 'plano_ensino_' . $disciplina->codigo;               //Define nome do arquivo de plano de disciplina
        /*Passa arquivo de plano de ensino, nome da paste onde deve ser salvo e nome do arquivo
         recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $plano_ensino = ManipuladorArquivo::salvar($request->file('plano_ensino'), 'plano_ensino', $nomeArquivo);
        $disciplina->ementa = $ementa;                                  //Passa caminho onde foi salvo ementa
        $disciplina->plano_ensino = $plano_ensino;                      //Passa caminho onde foi salvo plano de ensino
        $disciplina->save();                                            //Salva disciplina
        $pre_requisitos = $request->get('pre_requisitos');              //Pega relação de pré-requisitos
        if ($pre_requisitos != null):                                   //Verifica se relação de pré-requisitos não é nula
            $disciplina->pre_requisitos()->sync($pre_requisitos);       //Relaciona disciplina com pré-requisitos
        endif;
        $professores = $request->get('professores');                    //Pega relação de professores
        if ($professores != null):                                      //Verifica se relação de professores não é nula
            $disciplina->professors()->sync($professores);              //Relaciona disciplina com professores
        endif;
        return redirect('disciplinas');                                 //Redireciona para página inicial de disciplinas
    }

    /**Método que redireciona para página de edição de disciplina
     * @param $id int identificador da disciplina a ser editada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $disciplina = Disciplina::find($id);                            //Busca disciplina pelo id
        //Busca disciplinas em ordem alfabética excetuando a disciplina a ser editada
        $disciplinas = Disciplina::orderBy('nome')->get()->except($disciplina->id);
        $professores = Professor::orderBy('nome')->get();               //Busca relação de professores em ordem alfabética
        return view('disciplinas.editar', [
            'disciplina' => $disciplina,
            'disciplinas' => $disciplinas,
            'professores' => $professores]);                            //Redireciona para página de edição de disciplina
    }

    /**Método que realiza alteração de dados de disciplina
     * @param DisciplinaRequest $request relação de dados da disciplina a ser alterada
     * @param $id int identificador da disciplina a ser alterada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(DisciplinaRequest $request, $id)
    {
        $this->validate($request,
            ['codigo' => 'unique:disciplinas,codigo,' . $id]);          //Válida código da disciplina
        $disciplina = Disciplina::find($id);                            //Busca disciplina por id
        $pre_requisitos = $request->get('pre_requisitos');              //Pega relação de pré-requisitos
        if ($pre_requisitos != null):                                   //Verifica se relação de pré-requisitos não é nula
            $disciplina->pre_requisitos()->sync($pre_requisitos);       //Relaciona disciplina a pré-requisitos
        elseif ($disciplina->pre_requisitos != null):                   //Verifica se disciplina tem pré-requisitos, quando não existem pré-requisitos passados
            $disciplina->pre_requisitos()->detach();                    //Removo relação de disciplina com pré-requisitos
        endif;
        $professores = $request->get('professores');                    //Pega relação de professores
        if ($professores != null):                                      //Verifica se relação de professores não é nula
            $disciplina->professors()->sync($professores);              //Relaciona disciplina a professores
        elseif ($disciplina->professors != null):                       //Verifica se disciplina tem professores, quando não existem professores passados
            $disciplina->professors()->detach();                        //Remove relação de disciplina com professores
        endif;
        $nomeArquivo = 'ementa_' . $disciplina->codigo;
        /*Passa arquivo de ementa, nome da pasta onde deve ser salvo e nome do arquivo
        recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $ementa = ManipuladorArquivo::salvar($request->file('ementa'), 'ementa', $nomeArquivo);
        $nomeArquivo = 'plano_ensino_' . $disciplina->codigo;
        /*Passa arquivo de plano de ensino, nome da paste onde deve ser salvo e nome do arquivo
         recebendo o caminho onde arquivo foi salvo ou null se não tiver arquivo*/
        $plano_ensino = ManipuladorArquivo::salvar($request->file('plano_ensino'), 'plano_ensino', $nomeArquivo);
        //Verifica se caminho da ementa não está nulo e se é diferente do salvo no banco de dados
        if ($ementa != null && $ementa != $disciplina->ementa):
            ManipuladorArquivo::excluir($disciplina->ementa);           //Solicita exclusão do arquivo antigo
            $disciplina->ementa = $ementa;                              //Passa caminho para nova ementa
        endif;
        //Verifica se caminho do plano de ensino não está nulo e se é diferente do salvo no banco de dados
        if ($plano_ensino != null && $plano_ensino != $disciplina->plano_ensino):
            ManipuladorArquivo::excluir($disciplina->plano_ensino);     //Apaga o arquivo com plano de ensino anterior
            $disciplina->plano_ensino = $plano_ensino;                  //Passa cominho para novo plano de ensino
        endif;
        $disciplina->update($request->all());                           //Atualiza dados de disciplina
        return redirect()->route('disciplinas');                        //Redireciona à página inicial de disciplinas
    }

    /**Método que exclui disciplina
     * @param $id int identificador da disciplina a ser excluída
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Disciplina::find($id)->delete();                                //Busca disciplina pelo id e exclui
        return redirect()->route('disciplinas');                        //Redireciona à página inicial de disciplinas
    }

    /**
     * @param $id int identificador da disciplina que contém a ementa
     * @return \Illuminate\Http\Response abre ou baixa arquivo de ementa
     */
    /*public function ementa($id)
    {
        $disciplina = Disciplina::find($id);                            //Busca disciplina pelo id
        return ManipuladorArquivo::abrir($disciplina->ementa);          //Usa o manipulador de arquivo para abrir ou baixar
    }*/

    /**
     * @param $id int identificador da disciplina que contém o plano de ensino
     * @return \Illuminate\Http\Response abre ou baixa arquivo do plano de ensino
     */
    /*public function planoEnsino($id)
    {
        $disciplina = Disciplina::find($id);                            //Busca disciplina pelo id
        return ManipuladorArquivo::abrir($disciplina->plano_ensino);    //Usa o manipulador de arquivo para abrir ou baixar
    }*/
}