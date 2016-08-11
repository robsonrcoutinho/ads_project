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
                        <a href="{{ route('enades.editar', ['id'=>$enade->id]) }}"
                           class="btn green">Editar</a>
                        @endcan
                        @can('excluir', $enade)
                        <a href="{{ route('enades.excluir', ['id'=>$enade->id]) }}"
                           class="btn-danger btn red">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', new \adsproject\Enade)
                <a href="{{ route('enades.novo')}}" class="btn btn-default"> Novo dado ENADE</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
