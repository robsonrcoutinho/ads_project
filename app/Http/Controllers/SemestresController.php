<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 23/03/2016
 * Time: 10:16
 */
use adsproject\Semestre;
use adsproject\Http\Requests\SemestreRequest;
use adsproject\Disciplina;

/**Classe controller de semestres
 * Class SemestresController
 * @package adsproject\Http\Controllers
 */
class SemestresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de semestres
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $semestres = Semestre::paginate(config('constantes.paginacao'));    //Busca todos os semestres
        return view('semestres.index', ['semestres' => $semestres]);        //Redireciona à página inicial de semestres
    }

    /**Método que redireciona para página de inclusão de novo semestre
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();              //Busca todas as disciplinas ordenadas pelo nome
        return view('semestres.novo', ['disciplinas' => $disciplinas]); //Redireciona à página de inclusão de semestre
    }

    /**Método que inclui novo semestre no sistema
     * @param SemestreRequest $request relação de dados do semestre a ser inserido
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salvar(SemestreRequest $request)
    {
        $this->validate($request,
            ['codigo' => 'unique:semestres,codigo']);               //Valida código de semestre
        $semestre = Semestre::create($request->all());              //Cria novo semestre com dados passados
        $disciplinas = $request->get('disciplinas');                //Pega relação de disciplinas passadas
        if ($disciplinas != null):                                  //Verifica se relação de disciplinas não é nula
            $semestre->disciplinas()->sync($disciplinas);           //Relaciona disciplinas a semestre
        endif;
        return redirect('semestres');                               //Redireciona à página inicial de semestres
    }

    /**Método que redireciona para página de edição de semestre
     * @param $id identificador do semestre a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $semestre = Semestre::find($id);                            //Busca semestre por id
        $disciplinas = Disciplina::orderBy('nome')->get();          //Busca disciplinas ordenadas por nome
        //Redireciona para página de edição de semestre
        return view('semestres.editar', ['semestre' => $semestre, 'disciplinas' => $disciplinas]);
    }

    /**Método que realiza alteração de dados de semestre
     * @param SemestreRequest $request relação de dados do semestre a ser alterado
     * @param $id identificador do semestre a ser alterado
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(SemestreRequest $request, $id)
    {
        $this->validate($request,
            ['codigo' => 'unique:semestres,codigo,' . $id]);        //Valida código de semestre
        $semestre = Semestre::find($id);                            //Busca semestre por id
        $disciplinas = $request->get('disciplinas');                //Pega relação de disciplinas passadas
        if ($disciplinas != null):                                  //Verifica se relação de disciplinas não é nula
            $semestre->disciplinas()->sync($disciplinas);           //Relaciona semestre a disciplinas
        //Verifica se disciplinas em semestre não é nulo e não está vazio, em caso de relação de disciplinas passadas for nula
        elseif ($semestre->disciplinas != null && !$semestre->disciplinas->isEmpty()):
            $semestre->disciplinas()->detach();                     //Remove relação entre semestre e disciplinas
        endif;
        $semestre->update($request->all());                         //Atualiza dados de semestre
        return redirect()->route('semestres');                      //Redireciona para página inicial de semestres
    }
    /*Método que exclui semestre
     * public function excluir($id){
        Semestre::find($id)->delete();
        return redirect()->route('semestres');
    }*/
}
