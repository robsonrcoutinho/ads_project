@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Aviso</span>
        </div>
        {!! Form::open(['route'=>['avisos.alterar', $aviso->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $aviso->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', $aviso->titulo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('mensagem', 'Mensagem: ') !!}
            {!! Form::textarea ('mensagem', $aviso->mensagem, ['class'=>'materialize-textarea']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection