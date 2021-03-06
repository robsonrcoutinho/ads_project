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
                <th>Plano de ensino</th>
                <th>Pré-requisitos</th>
                @can('acao', new Disciplina())
                <th>Ação</th>
                @endcan
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
                            <a class="btn-flat disabled" target="_blank"
                               href="{{$disciplina->ementa}}">Ementa</a>

                        @endif
                    </td>
                    <td>
                        @if($disciplina->plano_ensino !=null && $disciplina->plano_ensino != '' )
                            <a class="btn-flat disabled" target="_blank"
                               href="{{$disciplina->plano_ensino}}">Plano de
                                Ensino</a>
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
                        <a class="btn-floating blue tooltipped" data-tooltip="Editar"
                           href="{{ route('disciplinas.editar', ['id'=>$disciplina->id]) }}">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        @endcan
                        @can('excluir', $disciplina)
                        <a class="btn-floating red btn-excluir tooltipped" data-tooltip="Excluir"
                           href="{{ route('disciplinas.excluir', ['id'=>$disciplina->id]) }}">
                            <i class="material-icons">delete</i>
                        </a>
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
        <a href="{{ route('disciplinas.novo')}}" class="btn btn-primary light-blue darken-3"> Nova disciplina</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection