
@extends('main')
@section('conteudo')
    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Avisos</strong> </span>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($avisos as $aviso)

                <tr>
                    <td>{{$aviso->id}}</td>
                    <td>{{$aviso->titulo}}</td>
                    <td>
                     <a href="{{ route('avisos.editar', ['idAviso'=>$aviso->id]) }}" class="btn-sm btn-success">Editar</a>
                     <a href="{{ route('avisos.excluir', ['idAviso'=>$aviso->id]) }}" class="btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('avisos.novo')}}" class="btn btn-default">Novo aviso</a>
    </div>
@endsection
