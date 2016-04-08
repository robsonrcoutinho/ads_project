@extends('main')
@section('conteudo')
    <div class="contegory">

        <span class="semestre total" style="display:block;"><strong>Nova Avaliação</strong> </span>
        {!! Form::open(['route'=>'avaliacoes.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('semestre_id', 'Semestre: ') !!}
            {!! Form::select ('semestre_id', $semestres, null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('inicio', 'Início: ') !!}
            {!! Form::date ('inicio', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('termino', 'Término: ') !!}
            {!! Form::date ('termino', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection