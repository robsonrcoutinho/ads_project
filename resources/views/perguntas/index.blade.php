@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
         <span class=" grey-text text-lighten-5">Perguntas</span>
         </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Enunciado</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($perguntas as $pergunta)
                <tr>
                    <td>{{$pergunta->id}}</td>
                    <td>{{$pergunta->enunciado}}</td>
                    <td>
                        @can('alterar', $pergunta)
                        <a href="{{ route('perguntas.editar', ['id'=>$pergunta->id]) }}" class="btn-sm btn-success">Editar</a>
                        @endcan
                        @can('excluir', $pergunta)
                        <a href="{{ route('perguntas.excluir', ['id'=>$pergunta->id]) }}" class="btn-sm btn-danger">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', new Pergunta())
        <a href="{{ route('perguntas.novo')}}" class="btn btn-default">Nova pergunta</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
