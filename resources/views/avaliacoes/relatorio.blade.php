<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Relátorio de Avaliação</title>
</head>
<body>
<img src="{{ public_path('images/logo_ifba.jpg')}}"/>

<div class="contegory">
    <div class="card-panel  #388e3c green darken-2 center">
        <span class=" white-text text-lighten-5">Relatório de Avaliação do Semestre: {!! $avaliacao->semestre->codigo !!}</span>
    </div>
    @foreach($disciplinas as $disciplina)
        <div class="form-group">
            <fieldset>
                <legend>{{$disciplina->nome}}</legend>
                @foreach($avaliacao->perguntas as $pergunta)
                    <p>{{$pergunta->enunciado}}</p>
                    @foreach(\adsproject\Http\Controllers\RespostasController::buscarEspecificas($avaliacao->id, $pergunta->id, $disciplina->id) as $resposta)
                        {{$resposta->campo_resposta}}
                        <br/>
                    @endforeach
                @endforeach
            </fieldset>
            @endforeach
        </div>
</div>
</body>
</html>
