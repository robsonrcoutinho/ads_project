@extends('main')
@section('conteudo')

<div class="contegory">
    <div class="card-panel teal escurecer-4">
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
        {!! Form::label ('Curriculo', 'Currículo (link): ') !!}
        {!! Form::text ('curriculo', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection