@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  teal escurecer-4">
        <span class=" grey-text text-lighten-5" >Disciplinas </span>

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
                            <a href="{{ $disciplina->ementa }}" class="btn-sm btn-success">Ementa</a>
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
                        <a href="{{ route('disciplinas.editar', ['id'=>$disciplina->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="{{ route('disciplinas.excluir', ['id'=>$disciplina->id]) }}" class="btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('disciplinas.novo')}}" class="btn btn-default"> Nova disciplina</a>

    </div>
    @endsection