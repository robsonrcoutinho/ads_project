<?php

namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 24/05/2016
 * Time: 10:09
 */
use adsproject\Avaliacao;
use adsproject\Resposta;
use adsproject\Aluno;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;

/**Classe controller de questionários
 * Class QuestionariosController
 * @package adsproject\Http\Controllers
 */
class QuestionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona usuário para página do questionário de avaliação
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        $user = Auth::getUser();                                                            //Pega usuário logado
        if ($user->role != 'aluno'):                                                        //Verifica se usuário não é aluno
            $rota = $user->role == 'admin' ? route('avaliacoes') : '/';                     //Atribui valor de rota
            $this->mensagem('Para acessar essa página usuário precisa ser aluno.', $rota);  //Executa método de mensagem
        endif;
        $avaliacao = Avaliacao::aberta()->first();                                          //Busca avaliação em aberto
        if ($avaliacao == null):                                                            //Se avaliação for nula (nenhuma avaliação em abaerto)
            $this->mensagem('Nenhuma avaliação disponível no momento', '/');                //Executa método de mensagem
        endif;
        $aluno = Aluno::buscarPorNomeEEmail($user->name, $user->email)->first();            //Busca aluno pelo nome e e-mail do usuário
        if ($aluno == null || $aluno->disciplinas()->get()->isEmpty()):                     //Verifica se aluno não tem disciplinas associadas
            $this->mensagem('Aluno impossibilitado de realizar avaliação.', '/');           //Executa método de mensagem
        endif;
        if ($aluno->avaliacoes()->get()->contains($avaliacao)):                             //Se aluno já fez avaliação
            $this->mensagem('Aluno já realizou última avaliação.', '/');                    //Executa método de mensagem
        endif;
        return view('questionarios.novo', compact('avaliacao', 'aluno'));                   //Redireciona para página de questionário
    }

    /** Método que salva questionário respondido pelo usuário
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function salvar()
    {
        $input = Input::all();                                                              //Pega todos os dados do questionário
        $validador = $this->validar($input);                                                //Executa método que retorna o validador
        if ($validador->fails()):                                                           //Verifica se houve falha na validação
            return redirect()->back()->withInput()->withErrors($validador);                 //Retorna a página com erros
        endif;
        $this->inserir($input);                                                             //Executa método para inserir respostas de questionário
        return redirect('/');                                                               //Redireciona à página inicial
    }

    /**Método que exibe mensagem ao usuário
     * @param $texto string texto da mensagem
     * @param $rota string página à qual o usuário deve ser redirecionado
     */
    private function mensagem($texto, $rota)
    {
        //Apresenta mensagem passada e redireciona para rota fornecida
        echo "<script>
                alert('$texto');
                window.location='$rota';
                </script>";
    }

    /**Método que realiza validação de respostas de questionário
     * @param $input Input entrada com dados para validação
     * @return mixed
     */
    private function validar($input)
    {
        $indices = collect($input['pergunta_id'])->keys();                                  //Pega indices com todas os ids de perguntas
        $regras = array();                                                                  //Cria arrai de regras
        $respostas = $input["campo_resposta"];                                              //Pega todos os campos resposta
        foreach ($indices as $indice):                                                      //Percorre todos os índices
            $regras[$indice] = 'required|max:250';                                          //Atribui às regras que o índice é obrigatório
        endforeach;
        $mensagens = ['required' => 'Existem respostas não informadas.',
            'max' => 'O campo resposta não deverá conter mais de :max caracteres.'];        //Cria mensagem personalizada para ausência de índice
        return Validator::make($respostas, $regras, $mensagens);                            //Cria e retorna validador passando respostas, regras e mensagens
    }

    /**Método que realiza inserção de respostas de questionário
     * @param $input Input entrada com dados do questionário
     */
    private function inserir($input)
    {
        $respostas = $input['campo_resposta'];                                          //Pega lista de campo_resposta
        $avaliacao = $input['avaliacao_id'];                                            //Paga id da avaliação
        $disciplinas = $input['disciplina_id'];                                         //Pega lista de disciplina_id (ids das disciplinas)
        $perguntas = $input['pergunta_id'];                                             //Pega lista de pergunta_id (ids das perguntas)
        foreach ($respostas as $indice => $resposta):                                   //Percorre lista de respostas
            $r = new Resposta();                                                        //Cria nova resposta
            $r->pergunta_id = $perguntas[$indice];                                      //Passa id da pergunta
            $r->campo_resposta = $resposta;                                             //Passa resposta dada (campo_resposta)
            $r->avaliacao_id = $avaliacao;                                              //Passa id da avaliação
            $r->disciplina_id = $disciplinas[$indice];                                  //Passa id da disciplina (disciplina_id)
            $r->save();                                                                 //Salva a resposta
        endforeach;
        $aluno = Aluno::find($input['aluno_id']);                                       //Busca aluno pelo id
        $aluno->avaliacoes()->attach($avaliacao);                                       //Relaciona aluno à avaliação
    }
}