@extends('main')
@section('conteudo')
<div class="contegory">
          <div class="card-panel  teal escurecer-4">
          <span class=" grey-text text-lighten-5" >Editar Aluno</span>
          </div>
    {!! Form::open(['route'=>['alunos.alterar', $alunos->id], 'method'=>'put']) !!}
    <div class="form-group">
        {!! Form::hidden ('id', $aluno->id, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('matricula', 'Matricula: ') !!}
        {!! Form::text ('matricula', $aluno->matricula, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', $aluno->nome, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('email', 'E-mail: ') !!}
        {!! Form::text ('email', $aluno->curriculo, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection