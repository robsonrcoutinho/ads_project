@extends('main')
@section('conteudo')
    <div class="contegory">
        <span class="semestre total" style="display:block;"><strong>Nova Pergunta</strong> </span>

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