@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Usuários</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Papel</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @can('alterar', $user)
                        <a href="{{ route('users.editar', ['id'=>$user->id]) }}" class="btn-sm btn-success">Editar</a>
                        @endcan
                        @can('excluir', $user)
                        <a href="{{ route('users.excluir', ['id'=>$user->id]) }}" class="btn-sm btn-danger">Excluir</a>
                        @endcan
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', $user)
         <a href="{{ route('users.novo')}}" class="btn btn-default"> Novo usuário</a>
        @endcan
    </div>
@endsection
