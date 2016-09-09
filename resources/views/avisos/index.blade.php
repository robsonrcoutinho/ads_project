@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Avisos</span>
        </div>
        {!! $avisos->render() !!}
        @forelse($avisos as $aviso)
            <fieldset>
                <legend><label title="titulo">{{$aviso->titulo}}</label></legend>
                <label>{{'Data/Hora: '.date('d/m/Y H:i:s', strtotime($aviso->created_at))}}</label>
                <textarea readonly class="materialize-textarea">{{$aviso->mensagem}}</textarea>
                @can('alterar', $aviso)
                <a class="btn-flat disabled"
                   href="{{ route('avisos.editar', ['id'=>$aviso->id]) }}">Editar</a>
                @endcan
                @can('excluir', $aviso)
                <a class="btn-flat disabled btn-excluir"
                   href="{{ route('avisos.excluir', ['id'=>$aviso->id]) }}">Excluir</a>
                @endcan
            </fieldset>
        @empty
            <tr>
                <td colspan="3">Sem Avisos!</td>
            </tr>
        @endforelse
        <br/>
        <br/>
        @can('salvar', new Aviso())
        <a href="{{ route('avisos.novo')}}" class="btn btn-primary light-blue darken-3">Novo aviso</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
