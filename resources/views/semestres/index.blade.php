@extends('main')
@section('conteudo')
    <div class="contegory">
         <div class="card-panel  teal escurecer-4">
         <span class=" grey-text text-lighten-5" >Semestres</span>
         </div>
         <table class="highlight  responsive-table">

            <thead>
            <tr>
                <th>Código</th>
                <th>Início</th>
                <th>Término</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($semestres as $semestre)

                <tr>
                    <td>{{$semestre->codigo}}</td>
                    <td>{{ date('d/m/Y', strtotime($semestre->inicio)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($semestre->termino)) }}</td>
                    <td>
                        <a href="{{ route('semestres.editar', ['codigo'=>$semestre->id]) }}" class="btn-sm btn-success"> Editar</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        <a href="{{ route('semestres.novo')}}" class="btn btn-default"> Novo Semestre</a>
    </div>
@endsection