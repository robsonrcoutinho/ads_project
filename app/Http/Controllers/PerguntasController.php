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

class PerguntasController extends Controller
{

    public function index()
    {
        $perguntas = Pergunta::all();
        return view('perguntas.index', ['perguntas' => $perguntas]);
    }

    public function novo()
    {
        return view('perguntas.novo');
    }

    public function salvar(PerguntaRequest $request)
    {
        $pergunta = Pergunta::create($request->all());
        if ($pergunta->pergunta_fechada):
            $opcoes = $request->get('opcoes_resposta');
            foreach ($opcoes as $opcao):
                $opcao_resposta = new OpcaoResposta();
                $opcao_resposta->resposta_opcao = $opcao;
                $opcao_resposta->pergunta()->associate($pergunta);
                $opcao_resposta->save();
            endforeach;
        endif;
        return redirect()->route('perguntas');
    }

    public function editar($id)
    {
        $pergunta = Pergunta::find($id);
        //return view('perguntas.editar', compact('pergunta'));
        return view('perguntas.editar', ['pergunta' => $pergunta]);
    }

    public function alterar(PerguntaRequest $request, $id)
    {
        $pergunta = Pergunta::find($id);
        if (!$pergunta->pergunta_fechada && $request->get('pergunta_fechada')):
            $this->inserirOpcoes($pergunta, $request);
        elseif ($pergunta->pergunta_fechada && !$request->get('pergunta_fechada')) :
            $pergunta->pergunta_fechada = false;
            $this->removerOpcoes($pergunta);
        elseif (count($request->get('opcoes_resposta')) == count($pergunta->opcoes_resposta)) :
            $this->atualizarOpcoes($pergunta, $request);
        elseif (count($request->get('opcoes_resposta')) > count($pergunta->opcoes_resposta)) :
            $this->aumentarOpcoes($pergunta, $request);
        elseif (count($request->get('opcoes_resposta')) < count($pergunta->opcoes_resposta)):
            $this->diminuirOpcoes($pergunta, $request);
        endif;
        $pergunta->update($request->all());
        return redirect('perguntas');
    }

    public function excluir($id)
    {
        $pergunta = Pergunta::find($id);
        $this->removerOpcoes($pergunta);
        $pergunta->delete();
        return redirect()->route('perguntas');
    }

//Inclui todas as opçoes de resposta
    private
    function inserirOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');
        if (count($opcoes) == 0):
            $request->merge(array('pergunta_fechada' => false));
            return;// $this->diminuirOpcoes($pergunta, $request);
        endif;

        foreach ($opcoes as $opcao):
            $opcao_resposta = new OpcaoResposta();
            $opcao_resposta->resposta_opcao = $opcao;
            $opcao_resposta->pergunta()->associate($pergunta);
            $opcao_resposta->save();
        endforeach;
    }

//Exclui todas as opçoes de resposta
    private
    function removerOpcoes(Pergunta $pergunta)
    {
        foreach ($pergunta->opcoes_resposta as $opcao):
            $opcao->delete();
        endforeach;
    }

//Altera opções de resposta mantendo a quantidade

    private function atualizarOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');
        for ($i = 0; $i < count($opcoes); $i++):
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            $opcao_resposta->resposta_opcao = $opcoes[$i];
            $opcao_resposta->update();
        endfor;
    }

//Aumenta o número de opções de resposta
    private
    function aumentarOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');
        $contador = count($pergunta->opcoes_resposta);
        $i = 0;
        while ($i < $contador):
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            $opcao_resposta->resposta_opcao = $opcoes[$i];
            $opcao_resposta->update();
            $i++;
        endwhile;
        $contador = count($opcoes);
        while ($i < $contador):
            $opcao_resposta = new OpcaoResposta();
            $opcao_resposta->resposta_opcao = $opcoes[$i];
            $opcao_resposta->pergunta()->associate($pergunta);
            $opcao_resposta->save();
            $i++;
        endwhile;
    }

//Duminui o número de opções de resposta
    private
    function diminuirOpcoes(Pergunta $pergunta, PerguntaRequest $request)
    {
        $opcoes = $request->get('opcoes_resposta');
        $contador = count($opcoes);
        $i = 0;
        while ($i < $contador):
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            $opcao_resposta->resposta_opcao = $opcoes[$i];
            $opcao_resposta->update();
            $i++;
        endwhile;
        $contador = count($pergunta->opcoes_resposta);
        while ($i < $contador):
            $opcao_resposta = OpcaoResposta::find($pergunta->opcoes_resposta[$i]->id);
            $opcao_resposta->delete();
            $i++;
        endwhile;

        if (count($opcoes) == 0):
            $request->merge(array('pergunta_fechada' => false));
        endif;
        //dd($request);
    }
}