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
                         <a class="btn-floating blue"   href="{{ route('enades.editar', ['id'=>$enade->id]) }}"><i class="material-icons">mode_edit</i></a>
                        @endcan
                        @can('excluir', $enade)
                       <a class="btn-floating red" href="{{ route('enades.excluir', ['id'=>$enade->id]) }}"><i class="material-icons">delete</i></a>
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
        <a href="{{ route('enades.novo')}}" class="btn btn-primary light-blue darken-3"> Novo dado ENADE</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
