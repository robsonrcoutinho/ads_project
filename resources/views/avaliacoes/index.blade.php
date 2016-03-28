@extends('main')
@section('conteudo')
    <div class="contegory">

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
                    <td>{{$avaliacao->semestre}}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->termino)) }}</td>
                    <td>
                        <a href="{{ route('avaliacoes.editar', ['codigo'=>$avaliacao->id]) }}" class="btn-sm btn-success">Editar</a>

                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('avaliacoes.novo')}}" class="btn btn-default"> Nova Avaliacao</a>

    </div>
@endsection