@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Usuário</span>
        </div>
        {!! Form::open(['route'=>['users.alterar', $user->id], 'method'=>'put']) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::hidden ('id', $user->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('name', 'Nome: ') !!}
            {!! Form::text ('name', $user->name, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::email ('email', $user->email, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            @can('alterar', $user)
            {!! Form::label ('role', 'Papel: ') !!}
            {!! Form::select ('role', $roles, $user->role, ['class'=>'browser-default']) !!}
            @else
                {!! Form::hidden ('role', $user->role, ['class'=>'form-control']) !!}
                @endcan
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
            {!! Form::submit ('Confirmar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection