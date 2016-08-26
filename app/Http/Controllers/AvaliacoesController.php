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

/**Classe controller de avalia��es
 * Class AvaliacoesController
 * @package adsproject\Http\Controllers
 */
class AvaliacoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**M�todo que redireciona para p�gina inicial de avalia��es
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::user()->role == 'aluno'):                                 //Verifica se usu�rio � aluno
            return redirect()->route('questionarios');                      //Redireciona para question�rio
        endif;
        $avaliacoes = Avaliacao::paginate(config('constantes.paginacao'));  //Busca todas as avalia��es
        return view('avaliacoes.index', ['avaliacoes' => $avaliacoes]);     //Redireciona para p�gina inicial de avalia��es
    }

    /**M�todo que redireciona para p�gina de inclus�o de nova avalia��o
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $semestres = Semestre::all()->lists('codigo', 'id');                //Busca todos os semestres pegando c�digo e id
        $perguntas = Pergunta::all();                                       //Busca todas as perguntas
        return view('avaliacoes.novo', compact('semestres', 'perguntas'));  //Redireciona para p�gina de inclus�o de avalia��o
    }

    /**M�todo que inclui nova avalia��o no sistema
     * @param AvaliacaoRequest $request rela��o de dados da avalia��o a ser inserida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AvaliacaoRequest $request)
    {
        $avaliacao = Avaliacao::create($request->all());                //Cria uma nova avalia��o com dados passados
        $perguntas = $request->get('perguntas');                        //Pega lista de perguntas
        if ($perguntas != null):                                        //Verifica se lista de perguntas n�o � nula
            $avaliacao->perguntas()->sync($perguntas);                  //Relaciona perguntas � avalia��o
        endif;
        return redirect()->route('avaliacoes');                         //Redireciona para p�gina inicial de avalia��es
    }

    /**M�todo que redireciona para p�gina de edi��o de avalia��o
     * @param $id int identificador da avalia��o a ser editada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avalia��o por id
        $semestres = Semestre::all()->lists('codigo', 'id');            //Busca todos os semestres pegando c�digo e id
        $perguntas = Pergunta::all();                                   //Busca todas as perguntas
        return view('avaliacoes.editar',
            compact('avaliacao', 'semestres', 'perguntas'));            //Redireciona para p�gina de edi��o de avalia��o
    }

    /**M�todo que realiza altera��o de dados de avalia��o
     * @param AvaliacaoRequest $request rela��o de dados da avalia��o a ser alterada
     * @param $id int identificador da avalia��o a ser alterada
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(AvaliacaoRequest $request, $id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avalia��o por id
        $perguntas = $request->get('perguntas');                        //Pega lista de perguntas
        if ($perguntas != null):                                        //Verifica se lista de perguntas n�o � nula
            $avaliacao->perguntas()->sync($perguntas);                  //Relaciona perguntas � avalia��o
        elseif ($avaliacao->perguntas != null):                         //Verifica se avalia��o tem perguntas, quando n�o existem perguntas passadas
            $avaliacao->perguntas()->detach();                          //Remove rela��o de perguntas da avalia��o
        endif;
        $avaliacao->update($request->all());                            //Atualiza dados da avalia��o
        return redirect()->route('avaliacoes');                         //Redireciona � p�gina inicial de avalia��es
    }

    /**M�todo que exclui avalia��o
     * @param $id int identificador da avalia��o a ser exclu�da
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Avaliacao::find($id)->delete();                                 //Busca avalia��o pelo id e exclui
        return redirect()->route('avaliacoes');                         //Redireciona � p�gina inicial de avalia��es
    }

    /** M�todo respons�vel por emitir relat�rio de avalia��o
     * @param $id int identificador da avalia��o para gera��o de relat�rio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function emitirRelatorio($id)
    {
        $avaliacao = Avaliacao::find($id);                              //Busca avalia��o por id
        $user = Auth::user();                                           //Busca usu�rio logado
        if ($avaliacao == null || $user == null):                       //Se n�o tiver avalia��o ou usu�rio
            return redirect('/');                                       //Retorna a p�gina inicial
        endif;
        $disciplinas = $avaliacao->semestre->disciplinas;               //Passa para vari�vel disciplinas do semestre
        if ($user->role == 'professor'):                                //Verifica se usu�rio � professor
            $professor = Professor::where('nome', $user->name)
                ->where('email', $user->email)->get()->first();         //Busca professor por nome e e-mail
            //Passa para vari�vel apenas disciplinas do professor que est�o no semestre
            $disciplinas = $professor->disciplinas->intersect($disciplinas);
        endif;
        $mpdf = new \mPDF();                                            //Instancia gerador de PDF
        //Passa arquivo css para gerador de PDF
        $mpdf->WriteHTML(file_get_contents('materialize-css/css/materialize.min.css'), 1);
        //Passa view para gera��o de PDF passando avalia��o e disciplinas
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