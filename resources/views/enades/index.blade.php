@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">ENADE - Exame Nacional de Desempenho de Estudantes</span>
        </div>
        <table class="highlight  responsive-table">
            <tbody>
            @foreach($enades as $enade)
                <tr>
                    <td>{{$enade->informacao}}</td>
                    <td>
                        @can('alterar', $enade)
                        <a class="btn-flat disabled"  href="{{ route('enades.editar', ['id'=>$enade->id]) }}">Editar</a>
                        @endcan
                        @can('excluir', $enade)
                        <a class="btn-flat disabled"  href="{{ route('enades.excluir', ['id'=>$enade->id]) }}">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            {!! $enades->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Enade())
        <a href="{{ route('enades.novo')}}" class="btn btn-default"> Novo dado ENADE</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
