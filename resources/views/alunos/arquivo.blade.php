@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Carregar Alunos</span>
        </div>
        {!! Form::open(['route'=>'alunos.carregar', 'enctype'=>'multipart/form-data']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::file('arquivo',['class'=>'form-control'] ) !!}
            <br/><br/>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection