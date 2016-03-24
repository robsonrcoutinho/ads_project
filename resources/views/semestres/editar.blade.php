@extends('layout')
@section('conteudo')
    <div class="contegory">
        <span class="semestre total" style="display:block;"><strong>Editar Semestre</strong> </span>

        {!! Form::open(['route'=>['semestres.alterar', $semestre->codigo], 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::label ('codigo', $semestre->codigo) !!}
            {!! Form::hidden ('codigo', $semestre->codigo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('inicio', 'Início: ') !!}
            {!! Form::date ('inicio', $semestre->inicio, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('termino', 'Término: ') !!}
            {!! Form::date ('termino', $semestre->termino, ['class'=>'form-control']) !!}
             </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection