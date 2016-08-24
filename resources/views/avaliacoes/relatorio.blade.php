@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">{!! 'Relatório de Avaliação do Semestre: '.$avaliacao->semestre->codigo !!}</span>
        </div>
        @foreach($disciplinas as $disciplina)
            <div class="form-group">
                <fieldset>
                    <legend>{{$disciplina->nome}}</legend>
                    <br/>
                    @foreach($avaliacao->perguntas as $pergunta)
                        {{$pergunta->enunciado}}
                        <br/>
                        @foreach(\adsproject\Http\Controllers\RespostasController::buscarEspecificas($avaliacao->id, $pergunta->id, $disciplina->id) as $resposta)
                            {{$resposta->campo_resposta}}
                            <br/>
                        @endforeach
                        <br/>
                    @endforeach
                </fieldset>
                @endforeach
            </div>
    </div>
@endsection