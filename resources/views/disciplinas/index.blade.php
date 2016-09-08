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
                         <div class="fixed-action-btn horizontal" style="bottom: 35px; right: 24px;">
                              <a class="btn-floating btn-large red">
                              <i class="large material-icons">settings</i>
                            </a>
                            <ul>
                             @can('alterar', $disciplina)
                             <li><a class="btn-floating yellow darken-1" href="{{ route('disciplinas.editar', ['id'=>$disciplina->id]) }}" ><i class="material-icons">mode_edit</i></a></li>
                             @endcan
                             @can('excluir', $disciplina)
                              <li><a class="btn-floating red"  href="{{ route('disciplinas.excluir', ['id'=>$disciplina->id]) }}"><i class="material-icons">delete</i></a></li> 
                             @endcan    
                             </ul>                  
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