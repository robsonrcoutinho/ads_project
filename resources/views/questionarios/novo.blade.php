@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Questionário de Avaliação</span>
        </div>
        {!! Form::open(['route'=>'questionarios.salvar']) !!}
        <div class="form-group">
            {!! Form::label ('semestre_id', 'Semestre: '.$avaliacao->semestre->codigo) !!}
        </div>
        <div class="form-group">
            <fieldset>
                <ol id="perguntas">
                    <legend>Perguntas</legend>

                    @foreach($avaliacao->perguntas as $pergunta)
                        <li class="collection-item">
                            {!! Form::label($pergunta->id, $pergunta->enunciado) !!}
                            @if($pergunta->pergunta_fechada)
                                <br/>
                                @foreach($pergunta->opcoes_resposta as $opcao)
                                    {!! Form::radio("campo_resposta[$pergunta->id]", $opcao->resposta_opcao, null,['id'=>$opcao->id, 'class'=>'with-gap']) !!}
                                    {!! Form::label($opcao->id, $opcao->resposta_opcao) !!}
                                    <br/>
                                @endforeach
                            @else
                                {!! Form::text("campo_resposta[$pergunta->id]", null, ['class'=>'form-control']) !!}
                            @endif
                            <br/>
                        </li>
                    @endforeach
                </ol>
                <br/>
            </fieldset>
        </div>
        <div class="form-group">
            <br/>
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection