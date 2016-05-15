@extends('main')
@section('conteudo')
      <div class="contegory">
       <div class="card-panel  teal escurecer-4">
        <span class=" grey-text text-lighten-5">Editar Avaliação</span>
     </div>
        {!! Form::open(['route'=>['avaliacoes.alterar', $avaliacao->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $avaliacao->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('semestre', 'Semestre: ') !!}
            {!! Form::select ('semestre', $semestres, $avaliacao->semestre, ['class'=>'form-control'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('inicio', 'Início: ') !!}
            {!! Form::date ('inicio', $avaliacao->inicio, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('termino', 'Término: ') !!}
            {!! Form::date ('termino', $avaliacao->termino, ['class'=>'form-control']) !!}
            <p draggable="true" ondragstart="#" ondragend="#"></p>
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection