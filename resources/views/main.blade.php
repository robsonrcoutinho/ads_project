<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Site Gerencial ADS</title>


    <!-- CSS  -->
    {!! Html::style('//fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! MaterializeCSS::include_all()!!} {!! Html::style('css/style.css') !!}


</head>
<body>
<nav class="#004d40 teal escurecer-4" role="navigation">


    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">IFBA</a>

        <ul class="right hide-on-med-and-down">

            <li><a href="#">Gerenciar Conta</a></li>
            <li><a href="#">Gerenciar Semestre</a></li>

        </ul>


        <ul id="nav-mobile " class="side-nav ">
            <li><a href="{{route('avisos')}}"> Consultar Avisos</a></li>
            <li><a href="{{route('professores')}}">Discentes</a></li>
            <li><a href="{{route('disciplinas')}}">Disciplinas</a></li>
            <li><a href="{{route('alunos')}}">Docentes</a></li>
            <li><a href="{{route('semestres')}}">Semestres</a></li>
            <li><a href="{{route('avaliacoes')}}">Avaliaçoes</a></li>
            <li><a href="{{route('documentos')}}">Documentos</a></li>
            <li><a href="#">Gerenciar Conta</a></li>
            <li><a href="#">Gerenciar Semestre</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse  show-on-large"><i
                    class="material-icons">menu</i></a>


    </div>
</nav>
<div class="section no-pad-bot" id="index-banner" style="background-image: url(&quot;../images/banner.jpg&quot;);">
    <div class="container">
        <br><br>

        <h1 class="header center orange-text">ADS </h1>

        <div class="row center">
            <h5 class="header col s12 light " style="color: blanchedalmond" ;>ANALISE E DESENVOLVIMENTO DE SISTEMAS</h5>
        </div>
        <div class="row center">
            <a href="{{route('avisos.novo')}}" id="download-button" class="btn-large waves-effect waves-light orange">Publicar
                Aviso</a>
        </div>
        <br><br>

    </div>
</div>


<div class="container">

    <div class="col s12 m12">

        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        @yield('conteudo')
    </div>
</div>
<br><br>

<div class="section">

</div>
</div>  <!--- container -->

<footer class="page-footer teal escurecer-4"><!--- Footer -->
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
                    <li><a class="white-text" href="#!"><i class="material-icons">phone</i> (73) 3281-2266</a></li>
                    <li><a class="white-text" href="#!"><i class="material-icons">email</i> email@decontato.com</a></li>
                    <li><a class="white-text" href="#!"></a></li>
                    <li><a class="white-text" href="#!"></a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">CONECTAR</h5>
                <ul>
                    <li><a class="white-text" href="#!">Facebook</a></li>
                    <li><a class="white-text" href="#!">Twitter</a></li>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/hammerjs/2.0.8/hammer.min.js"></script>

</body>
</html>