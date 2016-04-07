@extends('main')
@section('conteudo')

    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Avaliações</strong> </span>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Semestre</th>
                <th>Início</th>
                <th>Término</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($avaliacoes as $avaliacao)

                <tr>
                    <td>{{$avaliacao->id}}</td>
                    <td>{{$avaliacao->semestre_id}}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->termino)) }}</td>
                    <td>
                        <a href="{{ route('avaliacoes.editar', ['id'=>$avaliacao->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="{{ route('avaliacoes.excluir', ['id'=>$avaliacao->id]) }}" class="btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('avaliacoes.novo')}}" class="btn btn-default"> Nova avaliação</a>
    </div>
@endsection
