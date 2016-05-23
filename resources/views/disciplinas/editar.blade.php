@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  teal escurecer-4">
            <span class="grey-text text-lighten-5">Editar Professor</span>
        </div>
        {!! Form::open(['route'=>['disciplinas.alterar', $disciplina->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $disciplina->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::text ('codigo', $disciplina->codigo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('nome', 'Nome: ') !!}
            {!! Form::text ('nome', $disciplina->nome, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('carga_horaria', 'Carga Horária: ') !!}
            {!! Form::text ('carga_horaria', $disciplina->carga_horaria, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('ementa', 'Ementa (link): ') !!}
            {!! Form::text ('ementa', $disciplina->ementa, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <fieldset>
                <ul id="pre_requisitos">
                    <legend class="grey-text">Pré-requisitos</legend>
                    @foreach($disciplinas as $d)
                        {!! Form::checkbox('pre_requisitos[]', $d->id, $disciplina->pre_requisitos->contains($d),['id'=>$disciplina->codigo, 'class'=>'filled-in']) !!}
                        {!! Form::label('pre_requisitos[]', $disciplina->nome, ['for'=>$disciplina->codigo] ) !!}
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