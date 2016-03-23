@extends('layout')
@section('conteudo')

    <div class="container">

        <span class="semestre total" style="display:block;"><strong>Novo Documento</strong> </span>

        {!! Form::open(['route'=>'documentos.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('url', 'URL (link): ') !!}
            {!! Form::text ('url', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection