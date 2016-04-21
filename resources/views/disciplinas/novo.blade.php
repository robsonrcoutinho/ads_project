@extends('main')
@section('conteudo')
    
<div class="category">

    <span class="semestre total" style="display:block;"><strong>Nova Disciplina</strong> </span>
    {!! Form::open(['route'=>'disciplinas.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('codigo', 'Código: ') !!}
        {!! Form::text ('codigo', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('carga_horaria', 'Carga horária: ') !!}
        {!! Form::text ('carga_horaria', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('ementa', 'Ementa (link): ') !!}
        {!! Form::text ('ementa', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <fieldset>
            <ul id="pre_requisitos">
            <legend>Pré-requisitos</legend>
        @foreach($disciplinas as $disciplina)
            {!! Form::checkbox('pre_requisitos[]', $disciplina->id) !!}
            {{ $disciplina->nome }}
            <br/>
        @endforeach
            </ul>
        </fieldset>

    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
    @endsection