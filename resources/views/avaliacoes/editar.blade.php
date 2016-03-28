@extends('main')
@section('conteudo')
    <div class="contegory">
        <span class="semestre total" style="display:block;"><strong>Editar Avaliação</strong> </span>

        {!! Form::open(['route'=>['avaliacoes.alterar', $avaliacao->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $avaliacao->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('semestre', 'Semestre: ') !!}
            {!! Form::label ('semestre', $avaliacao->semestre) !!}

        </div>
        <div class="form-group">
            {!! Form::label ('inicio', 'Início: ') !!}
            {!! Form::date ('inicio', $avaliacao->inicio, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('termino', 'Término: ') !!}
            {!! Form::date ('termino', $avaliacao->termino, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection