@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Respostas</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Pergunta</th>
                <th>Resposta</th>
            </tr>
            </thead>
            <tbody>
            @foreach($respostas as $resposta)
                <tr>
                    <td>{{$resposta->id}}</td>
                    <td>{{$resposta->pergunta->enunciado}}</td>
                    <td>{{$resposta->campo_resposta}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection