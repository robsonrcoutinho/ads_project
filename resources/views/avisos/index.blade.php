@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Avisos</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Título</th>
                <th>Mensagem</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($avisos as $aviso)
                <tr>
                    <td>{{$aviso->titulo}}</td>
                    <td>{{$aviso->mensagem}}</td>
                    <td>
                        @can('alterar', $aviso)
                        <a href="{{ route('avisos.editar', ['id'=>$aviso->id]) }}" class="btn green">Editar</a>
                        @endcan
                        @can('excluir', $aviso)
                        <a href="{{ route('avisos.excluir', ['id'=>$aviso->id]) }}" class="btn-danger btn red">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Sem Avisos!</td>
                </tr>
            @endforelse
            </tbody>
            {!! $avisos->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Aviso())
        <a href="{{ route('avisos.novo')}}" class="btn btn-default">Novo aviso</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
