@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar dado ENADE</span>
        </div>
        {!! Form::open(['route'=>['enades.alterar', $enade->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $enade->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('informacao', 'Informação: ') !!}
            {!! Form::textarea ('informacao', $enade->informacao, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection