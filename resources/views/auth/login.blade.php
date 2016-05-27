
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

<div class="container">

<div class="col s12  #004d40 teal escurecer-4 "> <span class="flow-text  white-text"> Instituto Federal de Educação, Ciência e Tecnologia - Eunápolis
</span></div>

<div class="loggin">

    <div class="center">
        <div class="card bordered z-depth-2" style="margin:8% auto; max-width:400px;">
            <div class="card-header #004d40 teal escurecer-4">
                <i class="material-icons medium white-text">perm_identity</i>

            </div>
            <div class="card-content">
                <form>
                    <div class="input-field col s12">
                        <input id="Usuario" type="text" class="validate" value="{{ old('email') }}">
                        <label class ="left-align" for="Usuario">USUARIO</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" >
                        <label  class ="left-align" for="Senha">SENHA</label>
                    </div>
                    <button type="button" id="botao_login" name="botao_login" class="btn blue-grey right waves-effect waves-light white-text">Login</button>
                </form>
            </div>
            <div class="card-action clearfix">
                <div class="row">
                    <div class="col s6 text-p">
                        <a href="#" class="green-text accent-3  tooltipped" data-position="top" data-delay="30" data-tooltip="Recuperar Senha?">Esqueceu a senha?</a>
                    </div>
                    <div class="col s6 right-align text-p">
                        <a href="#" class="green-text accent-3  tooltipped" data-position="top" >Registra-se!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<footer class="page-footer #004d40 teal escurecer-4">
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
                <li><a class="white-text" href="#!"><i class="material-icons">phone</i> (73) 3281-2266</a></li>
                <li><a class="white-text" href="#!"><i class="material-icons">email</i> email@decontato.com</a></li>
                
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
        © 2016 IFBA. <a class="orange-text text-lighten-3" href="http://eunapolis.ifba.edu.br/"> Todos os direitos reservados</a>
    </div>
</div>
</footer>


 <!--  Scripts-->

 {!! Html::script('js/jquery-2.1.1.min.js') !!}
 {!! Html::script('js/init.js') !!}
 {!! Html::script('materialize-css/js/materialize.min.js')!!}

</body>
</html>
