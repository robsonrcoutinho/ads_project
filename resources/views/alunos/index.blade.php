@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Alunos</span>
        </div>
        <table class="highlight  responsive-table">

            <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>email</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alunos as $aluno)

                <tr>
                    <td>{{$aluno->matricula}}</td>
                    <td>{{$aluno->nome}}</td>

                    <td>
                    @if($aluno->email !=null && $aluno->email != '' )
                        {{ $aluno->email }}
                    @endif
                    <td>
                        @can('alterar', $aluno)
                        <a class="btn-flat disabled" href="{{ route('alunos.editar', ['id'=>$aluno->id]) }}">Editar</a>
                        @endcan
                        @can('excluir', $aluno)
                        <a class="btn-flat disabled"
                           href="{{ route('alunos.excluir', ['id'=>$aluno->id]) }}">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
            {!! $alunos->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', new Aluno())
        <a href="{{ route('alunos.novo')}}" class="btn btn-default">Novo Aluno</a>
        @endcan
        <br/> <br/>
        @can('carregar', new Aluno())
        <a href="{{ route('alunos.arquivo')}}" class="btn btn-default">Arquivo de Alunos</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection