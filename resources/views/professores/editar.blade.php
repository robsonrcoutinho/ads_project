@extends('layout')
@section('conteudo')
<div class="container">
     <span class="semestre total" style="display:block;"><strong>Editar Professor</strong> </span>

    {!! Form::open(['route'=>['professores.alterar', $professor->matricula], 'method'=>'put']) !!}

    <div class="form-group">
        {!! Form::label ('matricula', 'Matricula: ') !!}
        {!! Form::text ('matricula', $professor->matricula, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', $professor->nome, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('Curriculo', 'Curriculo (link): ') !!}
        {!! Form::text ('curriculo', $professor->curriculo, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection