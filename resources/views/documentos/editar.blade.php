@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Documento </span>
        </div>
        {!! Form::open(['route'=>['documentos.alterar', $documento->id], 'method'=>'put','enctype'=>'multipart/form-data']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::hidden ('id', $documento->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text('titulo', $documento->titulo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('arquivo', 'Arquivo: ') !!}
            <br/>
            {!! Form::file('arquivo',['class'=>'form-control'] ) !!}
            <br/> <br/>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection