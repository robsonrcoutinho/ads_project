@extends('main')
@section('conteudo')
    <div class="category">

        <span class="semestre total" style="display:block;"><strong>Disciplinas</strong> </span>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Carga horária</th>
                <th>Ementa</th>
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
                    <td>
                        <a href="{{ route('disciplinas.editar', ['codigo'=>$disciplina->codigo]) }}" class="btn-sm btn-success"> Editar</a>
                        <a href="{{ route('disciplinas.excluir', ['codigo'=>$disciplina->codigo]) }}" class="btn-sm btn-danger"> Excluir</a>
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