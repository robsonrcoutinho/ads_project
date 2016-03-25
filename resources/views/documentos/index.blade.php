@extends('main')
@section('conteudo')

    <div class="category">
        <span class="semestre total" style="display:block;"><strong>Documentos</strong> </span>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>URL</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documentos as $documento)

                <tr>
                    <td>{{$documento->id}}</td>
                    <td>{{$documento->titulo}}</td>
                    <td>
                           <a href="{{ $documento->url }}" >{{ $documento->url }}</a>
                    <td>
                        <a href="{{ route('documentos.editar', ['codigo'=>$documento->id]) }}" class="btn-sm btn-success">Editar</a>
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
