@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Registrar Usuário</span>
        </div>
        {!! Form::open(["route"=>"registrar"]) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label ('name', 'Nome: ') !!}
            {!! Form::text ('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::email ('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('role', 'Papel: ') !!}
            {!! Form::select ('role', ['aluno'=>'aluno', 'professor'=>'professor'], null, ['class'=>'browser-default']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password', 'Senha: ') !!}
            {!! Form::password ('password', ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password_confirmation', 'Confirmar a senha: ') !!}
            {!! Form::password ('password_confirmation', ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Confirmar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection