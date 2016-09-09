@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Editar Pergunta</span>
        </div>
        {!! Form::open(['route'=>['perguntas.alterar', $pergunta->id], 'method'=>'put']) !!}
        <div class="form-group">
            {!! Form::hidden ('id', $pergunta->id, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('enunciado', 'Enunciado: ') !!}
            {!! Form::textarea ('enunciado', $pergunta->enunciado, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::checkbox('pergunta_fechada', true, $pergunta->pergunta_fechada,['id'=>'pergunta_fechada', 'class'=>'filled-in']) !!}
            {!! Form::label('pergunta_fechada', 'Fechada') !!}
        </div>
        <div class="form-group" id="escondida">
            {!! Form::button('Adicionar Opção', ['id'=>'btn-adicionar', 'class'=>'btn']) !!}
            @if($pergunta->pergunta_fechada)
                @foreach($pergunta->opcoes_resposta as $opcao)
                    <div id="{{$opcao->id}}">
                        {!! Form::text('opcoes_resposta[]', $opcao->resposta_opcao, ['class'=>'form-control']) !!}
                        {!! Form::button('Excluir', ['class'=>'btn', 'onclick'=>"excluir_div($opcao->id)"]) !!}
                    </div>
                @endforeach
            @endif
        </div>
        <br/>
        <div class="form-group">
            {!! Form::submit ('Salvar', ['class'=>'btn btn-primary light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection