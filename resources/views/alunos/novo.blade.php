@extends('main')
@section('conteudo')

<div class="contegory">
    <div class="card-panel teal escurecer-4">
         <span class=" grey-text text-lighten-5">Novo Aluno</span>
    </div>
    {!! Form::open(['route'=>'alunos.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('matricula', 'Matrícula: ') !!}
        {!! Form::text ('matricula', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome Completo: ') !!}
        {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('email', 'E-mail: ') !!}
        {!! Form::text ('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection