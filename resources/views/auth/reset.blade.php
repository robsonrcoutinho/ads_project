@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Recuperar Senha</span>
        </div>
        {!! Form::open(['route'=>'password.reset', "method"=>'post']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::hidden ('token', $token, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::email('email', $email , ['class'=>'form-control','readonly']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password', 'Senha: ') !!}
            {!! Form::password ('password',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password_confirmation', 'Confirmar a senha: ') !!}
            {!! Form::password ('password_confirmation',['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection