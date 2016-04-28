@extends('main')
@section('conteudo')

    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Perguntas</strong> </span>
        <table class="table table-striped table-bordered table-hover">
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
                        <a href="{{ route('perguntas.editar', ['id'=>$pergunta->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="{{ route('perguntas.excluir', ['id'=>$pergunta->id]) }}" class="btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('perguntas.novo')}}" class="btn btn-default">Nova pergunta</a>
    </div>
@endsection
