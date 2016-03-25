@extends('main')
@section('conteudo')
<div class="contegory">
     <span class="semestre total" style="display:block;"><strong>Editar Professor</strong> </span>

    {!! Form::open(['route'=>['professores.alterar', $professor->matricula], 'method'=>'put']) !!}

    <div class="form-group">
        {!! Form::label ('matricula', 'Matrícula: ') !!}
        {!! Form::text ('matricula', $professor->matricula, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', $professor->nome, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('Curriculo', 'Currículo (link): ') !!}
        {!! Form::text ('curriculo', $professor->curriculo, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection