@extends('layout')
@section('conteudo')
    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Editar Documento</strong> </span>

        {!! Form::open(['route'=>['documentos.alterar', $documento->id], 'method'=>'put']) !!}

        <div class="form-group">
              {!! Form::hidden ('id', $documento->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', $documento->titulo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('url', 'URL: ') !!}
            {!! Form::text ('url', $documento->url, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection