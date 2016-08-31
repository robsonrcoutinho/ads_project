@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Disciplinas </span>

        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Carga horária</th>
                <th>Ementa</th>
                <th>Pré-requisitos</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($disciplinas as $disciplina)
                <tr>
                    <td>{{$disciplina->codigo}}</td>
                    <td>{{$disciplina->nome}}</td>
                    <td>{{$disciplina->carga_horaria}}</td>
                    <td>
                        @if($disciplina->ementa !=null && $disciplina->ementa != '' )
                            <a href="{{ $disciplina->ementa }}">Ementa</a>
                        @endif
                    </td>
                    <td>
                        @if($disciplina->pre_requisitos !=null || !$disciplina->pre_requisto->isEmpty )
                            @foreach($disciplina->pre_requisitos as $pre_requisito)
                                {{$pre_requisito->codigo}}<br/>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @can('alterar', $disciplina)
                        <a href="{{ route('disciplinas.editar', ['id'=>$disciplina->id]) }}">Editar</a>
                        @endcan
                        @can('excluir', $disciplina)
                        <a href="{{ route('disciplinas.excluir', ['id'=>$disciplina->id]) }}"
                           class="btn-excluir">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            {!! $disciplinas->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Disciplina())
        <a href="{{ route('disciplinas.novo')}}" class="btn btn-default"> Nova disciplina</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection