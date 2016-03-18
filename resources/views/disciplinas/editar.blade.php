@extends('layout')
@section('conteudo')
    <div class="container">

        <h1>Editar Professor</h1>
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['route'=>['disciplinas.alterar', $disciplina->codigo], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label ('codigo', 'Codigo: ') !!}
            {!! Form::text ('codigo', $disciplina->codigo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', $disciplina->nome, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('carga_horaria', 'Carga Horaria: ') !!}
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