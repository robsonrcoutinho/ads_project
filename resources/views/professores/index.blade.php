@extends('main')
@section('conteudo')
        <div class="category">
             <div class="card-panel  teal escurecer-4">
              <span class=" grey-text text-lighten-5" >Professores</span>
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
                            <a href="{{ $professor->curriculo }}" class="btn-sm btn-success">Curriculo</a>
                    @endif
                    <td>
                        <a href="{{ route('professores.editar', ['id'=>$professor->id]) }}" class="btn-sm btn-success">Editar</a>
                        <a href="{{ route('professores.excluir', ['id'=>$professor->id]) }}" class="btn-sm btn-danger">Excluir</a>
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