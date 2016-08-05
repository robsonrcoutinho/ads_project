@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Nova Informação ENADE</span>
        </div>
        {!! Form::open(['route'=>'enades.salvar']) !!}
        <div class="form-group">
            {!! Form::label ('informacao', 'Informação: ') !!}
            {!! Form::textarea ('informacao', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection