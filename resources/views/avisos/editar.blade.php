@extends('main')
@section('conteudo')
    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Editar Aviso</strong> </span>

        {!! Form::open(['route'=>['avisos.alterar', $aviso->id], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::hidden ('id', $aviso->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('titulo', 'Título: ') !!}
            {!! Form::text ('titulo', $aviso->titulo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('mensagem', 'Mensagem: ') !!}
            {!! Form::textarea ('mensagem', $aviso->mensagem, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection