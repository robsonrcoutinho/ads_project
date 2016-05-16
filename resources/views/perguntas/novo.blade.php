@extends('main')
@section('conteudo')
    <div class="contegory">
        <div class="card-panel teal escurecer-4">
            <span class=" grey-text text-lighten-5">Nova Pergunta</span>
        </div>

        {!! Form::open(['route'=>'perguntas.salvar']) !!}

        <div class="form-group">
            {!! Form::label ('enunciado', 'Enunciado: ') !!}
            {!! Form::textarea ('enunciado', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('pergunta_fechada' , true, null, ['id'=>'pergunta_fechada'])!!}{{ 'Fechada' }}
        </div>
        <div class="form-group" id="escondida">
            {!! Form::button('Adicionar Opção', ['id'=>'btn-adicionar', 'class'=>'btn']) !!}
        </div>
        <br/>

        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection