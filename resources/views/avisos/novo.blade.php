@extends('main')
@section('conteudo')
<div class="contegory">
     <div class="card-panel  #388e3c green darken-2 center">
        <span class=" grey-text text-lighten-5" >Novo Aviso </span>
     </div>
    {!! Form::open(['route'=>'avisos.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('titulo', 'Título: ') !!}
        {!! Form::text ('titulo', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('mensagem', 'Mensagem: ') !!}
        {!! Form::textarea ('mensagem', null, ['class'=>'materialize-textarea']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection