@extends('layout')
@section('conteudo')
<div class="container">

    <h1>Nova Disciplina</h1>
    @if($errors->any())
        <ul class="alert alert-warning">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    {!! Form::open(['route'=>'disciplinas.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('codigo', 'Codigo: ') !!}
        {!! Form::text ('codigo', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome: ') !!}
        {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('carga_horaria', 'Carga horaria: ') !!}
        {!! Form::text ('carga_horaria', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('ementa', 'Ementa (link): ') !!}
        {!! Form::text ('ementa', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
    @endsection