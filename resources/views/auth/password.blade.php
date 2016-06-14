@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Recuperar Senha</span>
        </div>
        {!! Form::open(["password/email"]) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label ('email', 'E-mail:',['class'=>'form-control']) !!}
            {!! Form::email ('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Confirmar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection