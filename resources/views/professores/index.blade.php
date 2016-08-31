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
                <th>Ação</th>
            </tr>
            </thead>

            <tbody>
            @foreach($professores as $professor)
                <tr>
                    <td>{{$professor->matricula}}</td>
                    <td>{{$professor->nome}}</td>
                    <td>
                        @if($professor->curriculo !=null && $professor->curriculo != '' )
                            <a href="{{ $professor->curriculo }}" class="btn-sm btn-success btn blue">Curriculo</a>
                    @endif
                    <td>
                        @can('alterar', $professor)
                        <a href="{{ route('professores.editar', ['id'=>$professor->id]) }}">Editar</a>
                        @endcan
                        @can('excluir', $professor)
                        <a href="{{ route('professores.excluir', ['id'=>$professor->id]) }}"
                           class="btn-excluir">Excluir</a>
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
        <a href="{{ route('professores.novo')}}" class="btn btn-default"> Novo professor</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection