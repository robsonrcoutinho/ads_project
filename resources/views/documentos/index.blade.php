@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Documentos</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Título</th>
                <th>Link</th>
                @can('acao', new Documento())
                <th>Ação</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($documentos as $documento)
                <tr>
                    <td>{{$documento->titulo}}</td>
                    <td>
                        @if($documento->url !=null && $documento->url != '' )
                            <a class="btn-flat disabled" target="_blank"
                               href="{{route('documentos.arquivo',['id'=>$documento->id])}}">Arquivo</a>
                        @endif
                    </td>
                    <td>
                        @can('alterar', $documento)
                        <a class="btn-floating blue"
                           href="{{ route('documentos.editar', ['id'=>$documento->id]) }}"><i class="material-icons">mode_edit</i></a>
                        @endcan
                        @can('excluir', $documento)
                        @if($documento->id>5)
                            <a class="btn-floating red" 
                               href="{{ route('documentos.excluir', ['id'=>$documento->id]) }}"><i class="material-icons">delete</i></a>
                        @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            {!! $documentos->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Documento())
        <a href="{{ route('documentos.novo')}}" class="btn btn-primary light-blue darken-3"> Novo documento</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
