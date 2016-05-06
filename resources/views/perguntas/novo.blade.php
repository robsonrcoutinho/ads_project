@extends('main')
@section('conteudo')
    <div class="contegory">
         <div class="card-panel teal escurecer-4">
         <span class=" grey-text text-lighten-5">Nova Pergunta</span>
         </div>

        {!! Form::open(['route'=>'perguntas.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('enunciado', 'Enunciado: ') !!}
            {!! Form::textarea ('enunciado', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('pergunta_fechada', true) !!}{{ 'Fechada' }}
        </div>

        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection