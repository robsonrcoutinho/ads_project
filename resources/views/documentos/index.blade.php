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
                            <a class="btn-floating grey darken-3 tooltipped" data-tooltip="Documento" target="_blank"
                               href="{{$documento->url}}">
                                <i class="material-icons">visibility</i>
                            </a>
                        @endif
                    </td>
                    <td>
                        @can('alterar', $documento)
                        <a class="btn-floating blue tooltipped" data-tooltip="Editar"
                           href="{{ route('documentos.editar', ['id'=>$documento->id]) }}">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        @endcan
                        @can('excluir', $documento)
                        <a class="btn-floating red btn-excluir tooltipped" data-tooltip="Excluir"
                           href="{{ route('documentos.excluir', ['id'=>$documento->id]) }}">
                            <i class="material-icons">delete</i>
                        </a>
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