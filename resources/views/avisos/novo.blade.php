@extends('main')
@section('conteudo')
    <div class="contegory">

        <span class="semestre total" style="display:block;"><strong>Novo Aviso</strong> </span>

        {!! Form::open(['route'=>'avisos.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('mensagem', 'Mensagem: ') !!}
            {!! Form::textarea ('mensagem', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection