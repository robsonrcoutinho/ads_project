<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 25/04/2016
 * Time: 09:34
 */
use adsproject\OpcaoResposta;
use adsproject\Pergunta;
use adsproject\Http\Requests\PerguntaRequest;

/**Classe controller de perguntas
 * Class PerguntasController
 * @package adsproject\Http\Controllers
 */
class PerguntasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de perguntas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $perguntas = Pergunta::paginate(config('constantes.paginacao'));    //Busca todas as perguntas
        return view('perguntas.index', ['perguntas' => $perguntas]);        //Redireciona à página inicial de perguntas
    }

    /**Método que redireciona para página de inclusão de nova pergunta
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('perguntas.novo');                                  //Redireciona à página de inclusão de perguntas
    }

    /**Método que inclui nova pergunta no sistema
     * @param PerguntaRequest $request relação de dados da pergunta a ser inserida
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(PerguntaRequest $request)
    {
        $pergunta = Pergunta::create($request->all());                      //Cria nova pergunta com dados passados
        $opcoes = $request->get('opcoes_resposta');                         //Pega relação de opções de resposta
        if ($pergunta->pergunta_fechada):                                   //Verifica se a pergunta é fechada
            if ($opcoes == null):                                           //Se opções for nulo
                $pergunta->pergunta_fechada = false;                        //Altera atributo pergunta_fechada para falso
                $pergunta->save();                                          //Salva alteração
            else:                                                           //Se opção não for nula
                foreach ($opcoes as $opcao):                                //Percorre lista de opções
                    if ($opcao != null && trim($opcao) != ""):              //Verifica se opção foi preenchida
                        $opcao_resposta = new OpcaoResposta();              //Cria nova opção de resposta
                        $opcao_resposta->resposta_opcao = trim($opcao);     //Passa resposta
                        $opcao_resposta->pergunta()->associate($pergunta);  //Associa opção de resposta à pergunta
                        $opcao_resposta->save();                            //Salva opção de resposta
                    endif;
                endforeach;
                if (count($pergunta->opcoes_resposta) == 0):                   //Verifica se quantidade de opções de resposta é zero
                    $pergunta->pergunta_fechada = false;                    //Altera atributo pergunta_fechada para falso
                    $pergunta->save();                                      //Salva alteração
                endif;
            endif;
        endif;
        return redirect()->route('perguntas');                          //Redireciona à página inicial de perguntas
    }

    /**Método que redireciona para página de edição de pergunta
     * @param $id identificador da pergunta a ser editada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $pergunta = Pergunta::find($id);                                //Busca pergunta por id
        return view('perguntas.editar', compact('pergunta'));           //Redireciona à página de edição de pergunta
    }

    /**Método que realiza alteração de dados de pergunta
     * @param PerguntaRequest $request relação de dados da pergunta a ser alterada
     * @param $id identificador da pergunta a ser alterada
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(PerguntaRequest $request, $id)
    {
        $pergunta = Pergunta::find($id);                                //Busca pergunta por id
        //Verifica se pergunta não é fechada e se foi passado atributo pergunta_fechada como verdadeiro
        if (!$pergunta->pergunta_fechada && $request->get('pergunta_fechada')):
            $this->inserirOpcoes($pergunta, $request);                  //Evoca método para inclusão de opções
        //Verifica se pergutna é fechada e foi passado atributo pergunta_fechada como falso
        elseif ($pergunta->pergunta_fechada && !$request->get('pergunta_fechada')) :
            $pergunta->pergunta_fechada = false;                        //Atribui falso para atributo pergunta_fechada
            $this->removerOpcoes($pergunta);                            //Evoca método de remoção de opções
        //Verifica se quantidade de opções de resposta à pergunta passadas é igual a que a pergunta já possui
        elseif (count($request->get('opcoes_resposta')) == count($pergunta->opcoes_resposta)) :
            $this->atualizarOpcoes($pergunta, $request);                //Evoca método de atualização de opções
        //Verifica se quantidade de opções de resposta à pergunta passada é maior que a que a pergunta já possui
        elseif (count($request->get('opcoes_resposta')) > count($pergunta->opcoes_resposta)) :
            $this->aumentarOpcoes($pergunta, $request);                 //Evoca método de aumento de opções
        //Verifica se quantidade de opções de resposta à pergunta passada é menor que a que a pergunta já possui
        elseif (count($request->get('opcoes_resposta')) < count($pergunta->opcoes_resposta)):
            $this->diminuirOpcoes($pergunta, $request);                 //Evoca método de diminuição de opções
        endif;
        $pergunta->update($request->all());                             //Atualiza dados de pergunta
        return redirect('perguntas');                                   //Redireciona à página inicial de perguntas
    }

    /**Método que exclui pergunta
     * @param $id identificador da pergunta a ser excluída
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        $pergunta = Pergunta::find($id);                                //Busca pergunta por id
        $this->removerOpcoes($pergunta);                                //Evoca método para remoção de opções de resposta relacionada à pergunta
        $pergunta->delete();                                            //Exclui a pergunta
        return redirect()->route('perguntas');                          //Redireciona à página inicial de perguntas
    }

    /**Inclui todas as opçoes de resposta
     * @param Pergunta $pergunta
     * @param PerguntaRequest $request
     */
    private function inserirOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');                     //Pega a relação de opções de resposta
        if (count($opcoes) == 0):                                       //Verifica se a quantidade é igual a zero
            $request->merge(array('pergunta_fechada' => false));        //Atualiza o atributo pergunta_fechada para falso
            return;                                                     //Retorna a quem evocou
        endif;
        foreach ($opcoes as $opcao):                                    //Percorre todas as opções
            if ($opcao != null && trim($opcao) != ""):                  //Verifica se opção foi preenchida
                $opcao_resposta = new OpcaoResposta();                  //Cria nova opção de resposta
                $opcao_resposta->resposta_opcao = trim($opcao);         //Passa opção de resposta
                $opcao_resposta->pergunta()->associate($pergunta);      //Relaciona opção à pergunta
                $opcao_resposta->save();                                //Salva opção de resposta
            endif;
        endforeach;
        if (count($pergunta->opcoes_resposta) == 0):                    //Verifica se quantidade de opções de resposta é zero
            $request->merge(array('pergunta_fechada' => false));        //Atualiza o atributo pergunta_fechada para falso
        endif;
    }

    /**Exclui todas as opçoes de resposta
     * @param Pergunta $pergunta
     */
    private function removerOpcoes(Pergunta $pergunta)
    {
        foreach ($pergunta->opcoes_resposta as $opcao):                 //Percorre opções de resposta da pergunta
            $opcao->delete();                                           //Apaga opção de resposta
        endforeach;
    }

    /**Altera opções de resposta mantendo a quantidade
     * @param Pergunta $pergunta
     * @param PerguntaRequest $request
     */
    private function atualizarOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');                     //Pega opções de resposta
        if (count($opcoes) == 0):                                       //Verifica se quantidade de opções é zero
            $request->merge(array('pergunta_fechada' => false));        //Atualiza o atributo pergunta_fechada para falso
        endif;
        for ($i = 0; $i < count($opcoes); $i++):                        //Percorre lista de opções de resposta
            //Busca opção de resposta pelo id
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            if ($opcoes[$i] != null && trim($opcoes[$i]) != ""):         //Verifica se opção foi preenchida
                $opcao_resposta->resposta_opcao = trim($opcoes[$i]);     //Atualiza valor do atributo resposta_opcao
                $opcao_resposta->update();                               //atualiza opção de resposta
            endif;
        endfor;
        if (count($pergunta->opcoes_resposta) == 0):                    //Verifica se quantidade de opções de resposta é zero
            $request->merge(array('pergunta_fechada' => false));        //Atualiza o atributo pergunta_fechada para falso
        endif;
    }

    /**Aumenta o número de opções de resposta
     * @param Pergunta $pergunta
     * @param PerguntaRequest $request
     */
    private function aumentarOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');                     //Pega opções de resposta
        $contador = count($pergunta->opcoes_resposta);                  //Cria variável por quantidade de opções da pergunta
        $i = 0;                                                         //Cria variável para utilizar como índice
        /*Estrutura de repetição que executa enquanto variável índice ($i) for menor que quantidade de opções
        de resposta da pergunta($contador) */
        while ($i < $contador):
            //Busca opção de resposta por id
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            if ($opcoes[$i] != null && trim($opcoes[$i]) != ""):        //Verifica se opção foi preenchida
                $opcao_resposta->resposta_opcao = trim($opcoes[$i]);    //Atualiza valor do atributo resposta_opcao
                $opcao_resposta->update();                              //Atualiza opção de resposta
            endif;
            $i++;                                                       //Incrementa índice
        endwhile;
        $contador = count($opcoes);                                     //Atribui quantidade de opções de resposta passada à $contador
        /*Estrutura de repetição que executa enquanto variável índice ($i) for menor que a quantidade de opções de
        resposta passadas($contador)*/
        while ($i < $contador):
            if ($opcoes[$i] != null && trim($opcoes[$i]) != ""):         //Verifica se opção foi preenchida
                $opcao_resposta = new OpcaoResposta();                   //Cria nova opção de resposta
                $opcao_resposta->resposta_opcao = trim($opcoes[$i]);     //Atribui valor de resposta_opcao
                $opcao_resposta->pergunta()->associate($pergunta);       //Associa opção de resposta à perguanta
                $opcao_resposta->save();                                 //Salva opção de resposta
            endif;
            $i++;                                                       //Incrementa índice
        endwhile;
    }

    /**Duminui o número de opções de resposta
     * @param Pergunta $pergunta
     * @param PerguntaRequest $request
     */
    private function diminuirOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');                     //Pega opções de resposta
        $contador = count($opcoes);                                     //Cria variável com quantidade opções de resposta
        $i = 0;                                                         //Cria índice
        /*Estrutura de repetição que executa enquanto variável índice ($i) for menor que a quantidade de opções de
        resposta passadas($contador)*/
        while ($i < $contador):
            //Busca opção de resposta por id
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            if ($opcoes[$i] != null && trim($opcoes[$i]) != ""):         //Verifica se opção foi preenchida
                $opcao_resposta->resposta_opcao = trim($opcoes[$i]);     //Atualiza atributo resposta_opcao
                $opcao_resposta->update();                               //Atualiza opção de resposta
            endif;
            $i++;                                                       //Incrementa índice
        endwhile;
        $contador = count($pergunta->opcoes_resposta);                  //Atribui quantidade de opções de resposta da pergunta ao contador
        /*Estrutura de repetição que executa enquanto variável índice ($i) for menor que quantidade de opções
        de resposta da pergunta($contador) */
        while ($i < $contador):
            //Busca opção de resposta por id
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            $opcao_resposta->delete();                                  //Exclui opção de resposta
            $i++;                                                       //Incrementa índice
        endwhile;
        if (count($opcoes) == 0):                                       //Se opções de resposta passada for zero
            $request->merge(array('pergunta_fechada' => false));        //Altera atributo pergunta_fechada para falso
        endif;
    }
}