@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Semestre</span>
        </div>
        {!! Form::open(['route'=>['semestres.alterar', $semestre->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $semestre->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('codigo', 'Código: ') !!}
            {!! Form::text ('codigo', $semestre->codigo, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('inicio', 'Início: ') !!}
            {!! Form::date ('inicio', $semestre->inicio, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('termino', 'Término: ') !!}
            {!! Form::date ('termino', $semestre->termino, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <fieldset>
                <ul id="disciplinas">
                    <legend>Disciplinas</legend>
                    @if($disciplinas!=null || !$disciplinas->isEmpty)
                        @foreach($disciplinas as $disciplina)
                            {!! Form::checkbox('disciplinas[]', $disciplina->id, $semestre->disciplinas->contains($disciplina),['id'=>$disciplina->id, 'class'=>'filled-in']) !!}
                            {!! Form::label($disciplina->id, $disciplina->nome) !!}
                            <br/>
                        @endforeach
                    @endif
                </ul>
            </fieldset>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection