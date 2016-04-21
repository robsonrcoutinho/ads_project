@extends('main')
@section('conteudo')

    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Documentos</strong> </span>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Link</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documentos as $documento)

                <tr>
                    <td>{{$documento->id}}</td>
                    <td>{{$documento->titulo}}</td>
                    <td>
                        @if($documento->url !=null && $documento->url != '' )
                            <a href="{{ $documento->url }}" class="btn-sm btn-success">LINK</a>
                        @endif
                    <td>
                        <a href="{{ route('documentos.editar', ['id'=>$documento->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="{{ route('documentos.excluir', ['id'=>$documento->id]) }}" class="btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('documentos.novo')}}" class="btn btn-default"> Novo documento</a>
    </div>
@endsection
