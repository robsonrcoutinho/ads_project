@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Novo Professor</span>
        </div>
        {!! Form::open(['route'=>'professores.salvar']) !!}
        <div class="form-group">
            {!! Form::label ('matricula', 'Matrícula: ') !!}
            {!! Form::text ('matricula', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::text ('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('Curriculo', 'Currículo (link): ') !!}
            {!! Form::text ('curriculo', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection