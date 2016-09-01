<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>IFBA - ADS</title>

    <!-- CSS  -->
    {!! Html::style('//fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! Html::style('materialize-css/css/materialize.min.css')!!} {!! Html::style('css/style.css') !!}

</head>
<body>

<!--- Topo  -->
<nav class="#388e3c green darken-2" role="navigation">

    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">IFBA</a>

        <ul class="right hide-on-med-and-down">

            @if(Auth::guest())
                <li><a href="{{route('registrar')}}">Registrar</a></li>
            @else
                <li><a href="{{route('users')}}">Gerenciar Conta</a></li>
                <li><a href="{{route('sair')}}">Sair</a></li>
        </ul>
        <ul id="slide-out" class="side-nav ">
            <li><a href="{{route('avaliacoes')}}">Avaliações</a></li>
            <li><a href="{{route('avisos')}}">Avisos</a></li>
            <li><a href="{{route('alunos')}}">Discentes</a></li>
            <li><a href="{{route('disciplinas')}}">Disciplinas</a></li>
            <li><a href="{{route('professores')}}">Docentes</a></li>
            <li><a href="{{route('documentos')}}">Documentos</a></li>
            <li><a href="{{route('enades')}}">ENADE</a></li>
            <li><a href="{{route('semestres')}}">Semestres</a></li>
            <li><a href="{{route('users')}}">Gerenciar Conta</a></li>
            <li><a href="{{route('sair')}}">Sair</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
        @endif
        <ul class="left hide-on-med-and-down">
            @if(Auth::check())
                <li><a href="">{{Auth::user()->name}}</a></li>
            @endif
            <li><a href="" onClick="history.go(-1)">Voltar</a></li>
        </ul>
    </div>
</nav>
<!-- Fim do topo --->

<!-- BI-->
<div class="col 12">
    <div class="row center">
        <h1 class="header center orange-text">ADS </h1>
        <h5 class="header col s12 light orange-text  ">ANÁLISE E DESENVOLVIMENTO DE SISTEMAS</h5>
    </div>

    @if(Auth::guest())
        <div class="row center">
            <a href="{{route('users')}}" id="download-button"
               class="btn-large waves-effect waves-light orange darken-1"> Login </a>
        </div>
    @else
        @can('salvar', new Aviso())
        <div class="row center">
            <a href="{{route('avisos.novo')}}" id="download-button"
               class="btn-large waves-effect waves-light orange">Publicar Aviso</a>
        </div>
        @endcan
    @endif
</div>
<!--BF -->
<!-- Conteudo-->
<div class="container">
    <div class="col 10 m10">
        <div class="col m10 ">

            @if($errors->any())
                <ul class="alert alert-warning">
                    @foreach(collect($errors->all())->unique() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif


            @yield('conteudo','

            <div class="container">
                       <div><h5 class="center-align">Bem vinda(o) ao Portal</h5></div>
                       <div class="center-align">
                        Esse sistema permite acesso a diversas informações relacionadas ao curso de
                        Tecnologia em Análise e Desenvolvimento de Sistema oferecido pelo Campus Eunápolis
                        do Instituto Federal de Educação, Ciência e Tecnologia do Estado da Bahia
                        Tais como:<br><br>

            <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Avisos</div>
                      <div class="collapsible-body"><p>Consulte os avisos relacionados ao curso de ADS.</p></div>
                    </li>
                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Avaliação semestral</div>
                      <div class="collapsible-body"><p>Realização da Avaliação de disciplinas  do curso.</p></div>
                    </li>
                    <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Calendário Acadêmico</div>
                      <div class="collapsible-body"><p>Consulte nosso calendario acadêmico.</p></div>
                    </li>
                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Grade Curricular</div>
                      <div class="collapsible-body"><p>Consulte as informaçoes da grade curricular do curso.</p></div>
                    </li>
                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Horário de Aula</div>
                      <div class="collapsible-body"><p>Consulte o horario aula do semestre.</p></div>
                    </li>

                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Lista de professores</div>
                      <div class="collapsible-body"><p>Consulte a lista de professores que fazem parte do corpo docente.</p></div>
                    </li>

                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Normas Acadêmicas</div>
                      <div class="collapsible-body"><p>Consulte as normas acadêmicas do Curso.</p></div>
                    </li>
                     <li>
                      <div class="collapsible-header"><i class="material-icons">label_outline</i>Projeto Pedagógico</div>
                      <div class="collapsible-body"><p>Consulte informaçoes sobre o Projeto Pedagogico relacionado ao curso.</p></div>
                    </li>



               </ul>
              </div>
        ')

          </div>
       </div>
    </div>
</div>
<!--Fim Conteudo-->

<footer class="page-footer #1b5e20 green darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">IFBA - Campus Eunápolis</h5>

                <p class="grey-text text-lighten-4">Tecnologia em Análise e Desenvolvimento de Sistemas.<br>
                    Av. David Jonas Fadini, 300 - Stela Reis, Eunápolis - BA, CEP: 45823-035.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">CONTATO</h5>
                <ul>
                    <li><a class="white-text"><i class="material-icons">phone</i> (73) 3281-2266</a></li>
                    <li><a class="white-text"><i class="material-icons">email</i> cleberlira@ifba.edu.br</a></li>

                </ul>
            </div>
            <div class="col l3 s12">
                <br>
                <ul>
                    <li><a class="white-text" href="https://www.facebook.com/IFEunapolis">Facebook</a></li>
                    <li><a class="white-text" href="https://twitter.com/Ifbaeunapolis">Twitter</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2016 IFBA. <a class="orange-text text-lighten-3" href="http://eunapolis.ifba.edu.br/"> Todos os direitos
                reservados</a>
        </div>
    </div>

</footer>
<!--  Scripts-->
{!! Html::script('js/jquery-2.1.1.min.js') !!}
{!! Html::script('js/init.js') !!}
{!! Html::script('materialize-css/js/materialize.min.js')!!}


</body>
</html>