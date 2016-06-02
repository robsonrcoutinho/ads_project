@extends('main')
@section('conteudo')
    <div class="category">
         <div class="card-panel teal escurecer-4">
         <span class=" grey-text text-lighten-5">Editar Documento </span>
         </div>
        {!! Form::open(['route'=>['documentos.alterar', $documento->id], 'method'=>'put']) !!}

        <div class="form-group">
              {!! Form::hidden ('id', $documento->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::label ('titulo', $documento->titulo, ['class'=>'form-control']) !!}
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