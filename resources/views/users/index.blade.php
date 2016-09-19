@extends('main')
@section('conteudo')

    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Usuários</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Papel</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>

                    <td>{{$user->name}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @can('alterar', $user)
                        <a class="btn-floating blue  tooltipped" data-tooltip="Editar"
                           href="{{ route('users.editar', ['id'=>$user->id]) }}">
                            <i class="material-icons">mode_edit</i>
                        </a>
                        @endcan
                        @can('excluir', $user)
                        <a class="btn-floating red btn-excluir tooltipped" data-tooltip="Excluir"
                           href="{{ route('users.excluir', ['id'=>$user->id]) }}">
                            <i class="material-icons">delete</i>
                        </a>
                        @endcan
                    </td>

                </tr>
            @endforeach
            </tbody>
            {!! $users->render() !!}
        </table>
        <br/>
        <br/>
        @can('salvar', $user)
        <a href="{{ route('users.novo')}}" class="btn btn-primary light-blue darken-3"> Novo usuário</a>
        @endcan
    </div>
    {!! Html::script('js/adsproject.js') !!}
@endsection
