@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Novo Documento</span>
        </div>
        {!! Form::open(['route'=>'documentos.salvar','enctype'=>'multipart/form-data']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('arquivo', 'Arquivo: ') !!}
            <br/>
            {!! Form::file('arquivo',['class'=>'form-control'] ) !!}
            <br/><br/>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection