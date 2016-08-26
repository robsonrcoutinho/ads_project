@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Questionário de Avaliação</span>
        </div>
        {!! Form::open(['route'=>'questionarios.salvar']) !!}
        <div class="form-group">
            {!! Form::hidden ('avaliacao_id', $avaliacao->id, ['class'=>'form-control']) !!}
            {!! Form::hidden ('aluno_id', $aluno->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('semestre_id', 'Semestre: '.$avaliacao->semestre->codigo) !!}
        </div>
        @foreach($aluno->disciplinas as $disciplina)
            <div class="form-group">
                <fieldset>
                    <legend>{{ $disciplina->nome }}</legend>
                    <ol>
                        @foreach($avaliacao->perguntas as $pergunta)
                            <li class="collection-item">
                                {!! Form::label('enunciado', $pergunta->enunciado) !!}
                                {!! Form::hidden("pergunta_id[$pergunta->id $disciplina->codigo]", $pergunta->id) !!}
                                {!! Form::hidden("disciplina_id[$pergunta->id $disciplina->codigo]", $disciplina->id) !!}
                                @if($pergunta->pergunta_fechada)

                                    @foreach($pergunta->opcoes_resposta as $opcao)
                                        <br/>
                                        {!! Form::radio("campo_resposta[$pergunta->id $disciplina->codigo]", $opcao->resposta_opcao, null,['id'=>$opcao->id.$disciplina->codigo, 'class'=>'with-gap']) !!}
                                        {!! Form::label($opcao->id.$disciplina->codigo, $opcao->resposta_opcao) !!}
                                    @endforeach
                                @else
                                    {!! Form::text("campo_resposta[$pergunta->id $disciplina->codigo]", null, ['class'=>'form-control']) !!}
                                @endif
                                <br/>
                            </li>
                        @endforeach
                    </ol>
                    <br/>
                </fieldset>
            </div>
        @endforeach
        <div class="form-group">
            <br/>
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection