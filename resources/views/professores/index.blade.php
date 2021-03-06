@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Professores</span>
        </div>
        <table class="highlight  responsive-table">

            <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>Curriculo</th>
                @can('acao', new Professor())
                <th>Ação</th>
                @endcan
            </tr>
            </thead>

            <tbody>
            @foreach($professores as $professor)
                <tr>
                    <td>{{$professor->matricula}}</td>
                    <td>{{$professor->nome}}</td>
                    <td>
                        @if($professor->curriculo !=null && $professor->curriculo != '' )
                            <a class="btn-floating grey darken-3 tooltipped" data-tooltip="Curriculo" target="_blank"
                               href="{{ $professor->curriculo }}">
                                <i class="material-icons">description</i>
                            </a>
                    @endif
                    <td>
                        @can('alterar', $professor)
                        <a class="btn-floating blue tooltipped" data-tooltip="Editar"
                           href="{{ route('professores.editar', ['id'=>$professor->id]) }}">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        @endcan
                        @can('excluir', $professor)
                        <a class="btn-floating red btn-excluir tooltipped" data-tooltip="Excluir"
                           href="{{ route('professores.excluir', ['id'=>$professor->id]) }}">
                            <i class="material-icons">delete</i>
                        </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            {!! $professores->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Professor())
        <a href="{{ route('professores.novo')}}" class="btn btn-primary light-blue darken-3"> Novo professor</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection