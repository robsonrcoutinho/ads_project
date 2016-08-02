@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Respostas</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Pergunta</th>
                <th>Resposta</th>
                <th>Disciplina</th>
            </tr>
            </thead>
            <tbody>
            @foreach($respostas as $resposta)
                <tr>
                    <td>{{$resposta->pergunta->enunciado}}</td>
                    <td>{{$resposta->campo_resposta}}</td>
                    <td>{{$resposta->disciplina->nome}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection