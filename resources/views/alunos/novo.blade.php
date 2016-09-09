@extends('main')
@section('conteudo')

<div class="contegory">
    <div class="card-panel  #388e3c green darken-2 center">
         <span class=" grey-text text-lighten-5">Novo Aluno</span>
    </div>
    {!! Form::open(['route'=>'alunos.salvar']) !!}

    <div class="form-group">
        {!! Form::label ('matricula', 'Matrícula: ') !!}
        {!! Form::text ('matricula', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('nome', 'Nome Completo: ') !!}
        {!! Form::text ('nome', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label ('email', 'E-mail: ') !!}
        {!! Form::text ('email', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <fieldset>
            <ul id="disciplinas">
                <legend>Disciplinas</legend>
                @foreach($disciplinas as $disciplina)
                    {!! Form::checkbox('disciplinas[]', $disciplina->id, null,['id'=>$disciplina->id, 'class'=>'filled-in']) !!}
                    {!! Form::label($disciplina->id, $disciplina->nome) !!}
                    <br/>
                @endforeach
            </ul>
        </fieldset>
        </div>
    <div class="form-group">
        {!! Form::submit ('Salvar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
    </div>
    {!! Form::close() !!}

</div>
@endsection