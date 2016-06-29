@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel teal escurecer-4">
            <span class=" grey-text text-lighten-5">Carregar Alunos</span>
        </div>
        {!! Form::open(['route'=>'alunos.carregar', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            {!! Form::file('arquivo',['class'=>'form-control'] ) !!}
            <br /><br />
        </div>

        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection