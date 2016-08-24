@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Professor</span>
        </div>
        {!! Form::open(['route'=>['professores.alterar', $professor->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $professor->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('matricula', 'Matricula: ') !!}
            {!! Form::text ('matricula', $professor->matricula, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', $professor->nome, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::text ('email', $professor->email, ['class'=>'form-control']) !!}
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