@extends('main')
@section('conteudo')
    <div class="contegory">
        <span class="semestre total" style="display:block;"><strong>Editar Professor</strong> </span>

        {!! Form::open(['route'=>['disciplinas.alterar', $disciplina->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $disciplina->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::text ('codigo', $disciplina->codigo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', $disciplina->nome, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('carga_horaria', 'Carga Horária: ') !!}
            {!! Form::text ('carga_horaria', $disciplina->carga_horaria, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('ementa', 'Ementa (link): ') !!}
            {!! Form::text ('ementa', $disciplina->ementa, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
    @endsection