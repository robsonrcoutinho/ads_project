@extends('main')
@section('conteudo')
        <div class="category">
            <span class="semestre total" style="display:block;"><strong>Professores</strong> </span>

        <table class="table table-striped table-bordered table-hover">

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
                            <a href="{{ $professor->curriculo }}" class="btn-sm btn-success">Curriculo</a>
                    @endif
                    <td>
                        <a href="{{ route('professores.editar', ['matricula'=>$professor->matricula]) }}" class="btn-sm btn-success"> Editar</a>
                        <a href="{{ route('professores.excluir', ['matricula'=>$professor->matricula]) }}" class="btn-sm btn-danger"> Excluir</a>
                    </td>
                </tr>

            @endforeach
            </tbody>

        </table>

        <br/>
        <br/>
        <a href="{{ route('professores.novo')}}" class="btn btn-default"> Novo professor</a>
        </div>
@endsection