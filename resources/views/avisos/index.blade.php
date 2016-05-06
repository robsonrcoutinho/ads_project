@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  teal escurecer-4">
        <span class=" grey-text text-lighten-5" >Avisos</span>
        </div>
        <table class="highlight  responsive-table" >
            <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($avisos as $aviso)
                <tr>
                    <td>{{$aviso->id}}</td>
                    <td>{{$aviso->titulo}}</td>
                    <td>
                        <a href="{{ route('avisos.editar', ['id'=>$aviso->id]) }}" class="btn disabled" >Editar</a>
                        <a href="{{ route('avisos.excluir', ['id'=>$aviso->id]) }}" class="btn disabled">Excluir</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Sem Postagem!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('avisos.novo')}}" class="btn btn-default">Novo aviso</a>
    </div>
@endsection
