@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Avaliações</span>
        </div>
        <table class="highlight  responsive-table">
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
            @forelse($avaliacoes as $avaliacao)

                <tr>
                    <td>{{$avaliacao->id}}</td>
                    <td>{{$avaliacao->semestre->codigo}}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($avaliacao->termino)) }}</td>
                    <td>
                        @can('alterar', $avaliacao)
                        <a href="{{ route('avaliacoes.editar', ['id'=>$avaliacao->id]) }}" class="btn-sm btn-success">Editar</a>
                        @endcan
                        @can('excluir', $avaliacao)
                        <a href="{{ route('avaliacoes.excluir', ['id'=>$avaliacao->id]) }}" class="btn-sm btn-danger">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Sem Avaliações!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', new Avaliacao())
        <a href="{{ route('avaliacoes.novo')}}" class="btn btn-default"> Nova avaliação</a>
        @endcan
    </div>
@endsection
