@extends('main')
@section('conteudo')
    <div class="category">
         <div class="card-panel teal escurecer-4">
         <span class=" grey-text text-lighten-5">Editar Pergunta</span>
        </div>
        {!! Form::open(['route'=>['perguntas.alterar', $pergunta->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::hidden ('id', $pergunta->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('enunciado', 'Enunciado: ') !!}
            {!! Form::textarea ('enunciado', $pergunta->enunciado, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::checkbox('pergunta_fechada', true, $pergunta->pergunta_fechada) !!}{{ 'Fechada' }}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection