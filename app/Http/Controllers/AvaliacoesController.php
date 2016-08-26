<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 06/04/2016
 * Time: 09:22
 */
use adsproject\Avaliacao;
use adsproject\Http\Requests\AvaliacaoRequest;
use adsproject\Professor;
use adsproject\Semestre;
use adsproject\Pergunta;
use Auth;

//use mPDF;

/**Classe controller de avaliações
 * Class AvaliacoesController
 * @package adsproject\Http\Controllers
 */
class AvaliacoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de avaliações
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->role == 'aluno'):                                 //Verifica se usuário é aluno
            return redirect()->route('questionarios');                      //Redireciona para questionário
        endif;
        $avaliacoes = Avaliacao::paginate(config('constantes.paginacao'));  //Busca todas as avaliações
        return view('avaliacoes.index', ['avaliacoes' => $avaliacoes]);     //Redireciona para página inicial de avaliações
    }

    /**Método que redireciona para página de inclusão de nova avaliação
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $semestres = Semestre::all()->lists('codigo', 'id');                //Busca todos os semestres pegando código e id
        $perguntas = Pergunta::all();                                       //Busca todas as perguntas
        return view('avaliacoes.novo', compact('semestres', 'perguntas'));  //Redireciona para página de inclusão de avaliação
    }

    /**Método que inclui nova avaliação no sistema
     * @param AvaliacaoRequest $request relação de dados da avaliação a ser inserida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AvaliacaoRequest $request)
    {
        $avaliacao = Avaliacao::create($request->all());                //Cria uma nova avaliação com dados passados
        $perguntas = $request->get('perguntas');                        //Pega lista de perguntas
        if ($perguntas != null):                                        //Verifica se lista de perguntas não é nula
            $avaliacao->perguntas()->sync($perguntas);                  //Relaciona perguntas à avaliação
        endif;
        return redirect()->route('avaliacoes');                         //Redireciona para página inicial de avaliações
    }

    /**Método que redireciona para página de edição de avaliação
     * @param $id int identificador da avaliação a ser editada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avaliação por id
        $semestres = Semestre::all()->lists('codigo', 'id');            //Busca todos os semestres pegando código e id
        $perguntas = Pergunta::all();                                   //Busca todas as perguntas
        return view('avaliacoes.editar',
            compact('avaliacao', 'semestres', 'perguntas'));            //Redireciona para página de edição de avaliação
    }

    /**Método que realiza alteração de dados de avaliação
     * @param AvaliacaoRequest $request relação de dados da avaliação a ser alterada
     * @param $id int identificador da avaliação a ser alterada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(AvaliacaoRequest $request, $id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avaliação por id
        $perguntas = $request->get('perguntas');                        //Pega lista de perguntas
        if ($perguntas != null):                                        //Verifica se lista de perguntas não é nula
            $avaliacao->perguntas()->sync($perguntas);                  //Relaciona perguntas à avaliação
        elseif ($avaliacao->perguntas != null):                         //Verifica se avaliação tem perguntas, quando não existem perguntas passadas
            $avaliacao->perguntas()->detach();                          //Remove relação de perguntas da avaliação
        endif;
        $avaliacao->update($request->all());                            //Atualiza dados da avaliação
        return redirect()->route('avaliacoes');                         //Redireciona à página inicial de avaliações
    }

    /**Método que exclui avaliação
     * @param $id int identificador da avaliação a ser excluída
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Avaliacao::find($id)->delete();                                 //Busca avaliação pelo id e exclui
        return redirect()->route('avaliacoes');                         //Redireciona à página inicial de avaliações
    }

    /** Método responsável por emitir relatório de avaliação
     * @param $id int identificador da avaliação para geração de relatório
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function emitirRelatorio($id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avaliação por id
        $user = Auth::user();                                           //Busca usuário logado
        if ($avaliacao == null || $user == null):                       //Se não tiver avaliação ou usuário
            return redirect('/');                                       //Retorna a página inicial
        endif;
        $disciplinas = $avaliacao->semestre->disciplinas;               //Passa para variável disciplinas do semestre
        if ($user->role == 'professor'):                                //Verifica se usuário é professor
            $professor = Professor::where('nome', $user->name)
                ->where('email', $user->email)->get()->first();         //Busca professor por nome e e-mail
            //Passa para variável apenas disciplinas do professor que estão no semestre
            $disciplinas = $professor->disciplinas->intersect($disciplinas);
        endif;
        $mpdf = new \mPDF();                                            //Instancia gerador de PDF
        //Passa arquivo css para gerador de PDF
        $mpdf->WriteHTML(file_get_contents('materialize-css/css/materialize.min.css'), 1);
        //Passa view para geração de PDF passando avaliação e disciplinas
        $mpdf->WriteHTML(utf8_encode(view('avaliacoes.relatorio', ['avaliacao' => $avaliacao, 'disciplinas' => $disciplinas])));
        $mpdf->Output();                                                //Gera PDF
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