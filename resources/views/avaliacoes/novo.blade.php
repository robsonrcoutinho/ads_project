@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Nova Avaliação</span>
        </div>
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
            <fieldset>
                <ul id="perguntas">
                    <legend>Perguntas</legend>
                    @foreach($perguntas as $pergunta)
                        {!! Form::checkbox('perguntas[]', $pergunta->id) !!}
                        {{ $pergunta->enunciado }}
                        <br/>
                    @endforeach
                </ul>
                <a href="{{ route('perguntas')}}" class="btn"> Perguntas </a>
            </fieldset>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection