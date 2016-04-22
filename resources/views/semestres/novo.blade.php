@extends('main')
@section('conteudo')
    <div class="contegory">

        <span class="semestre total" style="display:block;"><strong>Novo Semestre</strong> </span>
        {!! Form::open(['route'=>'semestres.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::text ('codigo', null, ['class'=>'form-control']) !!}
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
                <ul id="disciplinas">
                    <legend>Disciplinas</legend>
                    @foreach($disciplinas as $disciplina)
                        {!! Form::checkbox('disciplinas[]', $disciplina->id) !!}
                        {{ $disciplina->nome }}
                        <br/>
                    @endforeach
                </ul>
            </fieldset>

        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endsection