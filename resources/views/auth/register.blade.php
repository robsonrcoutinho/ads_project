<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Site Gerencial ADS</title>
    <!-- CSS  -->
    {!! Html::style('//fonts.googleapis.com/icon?family=Material+Icons') !!}
    {!! MaterializeCSS::include_all()!!}
    {!! Html::style('css/style.css') !!}

</head>
<body>

<nav class="#1b5e20 green darken-3" role="navigation">


    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo center">IFBA</a>

    </div>
</nav>

<!-- BI-->
<div class="col 12" >
    <div class="row center">
        <h1 class="header center orange-text">ADS </h1>
        <h5 class="header col s12 light orange-text">ANALISE E DESENVOLVIMENTO DE SISTEMAS</h5>
    </div>
</div>

    <div class="container">
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach(collect($errors->all())->unique() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Registrar Usuário</span>
        </div>
        {!! Form::open(["route"=>"registrar"]) !!}
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label ('name', 'Nome: ') !!}
            {!! Form::text ('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('email', 'E-mail: ') !!}
            {!! Form::email ('email', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('role', 'Papel: ') !!}
            {!! Form::select ('role', ['aluno'=>'aluno', 'professor'=>'professor'], null, ['class'=>'browser-default']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password', 'Senha: ') !!}
            {!! Form::password ('password', ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label ('password_confirmation', 'Confirmar a senha: ') !!}
            {!! Form::password ('password_confirmation', ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit ('Confirmar', ['class'=>'btn btn-primary  light-blue darken-3']) !!}
        </div>
        {!! Form::close() !!}
    </div>


<footer class="page-footer #1b5e20 green darken-3">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">IFBA - Campus Eunapolis</h5>

                <p class="grey-text text-lighten-4">Tecnologia em Análise e Desenvolvimento de Sistemas.<br>
                    Av. David Jonas Fadini, 300 - Stela Reis, Eunápolis - BA, CEP: 45823-035.</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">CONTATO</h5>
                <ul>
                    <li><a class="white-text"><i class="material-icons">phone</i> (73) 3281-2266</a></li>
                    <li><a class="white-text"><i class="material-icons">email</i> email@decontato.com</a></li>

                </ul>
            </div>
            <div class="col l3 s12">
                <br>
                <ul>
                    <li><a class="white-text">Facebook</a></li>
                    <li><a class="white-text">Twitter</a></li>

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
