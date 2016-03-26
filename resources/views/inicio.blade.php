<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <title>ADS</title>
    {!! Html::style('css/normalize.css') !!}
    {!! Html::style('css/demo.css') !!}
    {!! Html::style('css/component.css') !!}
    {!! Html::style('css/component.css') !!}
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/bootstrap-select.css') !!}
    {!! Html::style('css/style.css') !!}


            <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design"/>

    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    <!-- //for-mobile-apps -->
    <!--fonts-->
    {!! Html::style('//fonts.googleapis.com/css?family=Ubuntu+Condensed') !!}
    {!! Html::style('//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic') !!}
            <!--//fonts-->

    <!-- js -->
    {!! Html::script('js/jquery.min.js') !!}
            <!-- js -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/bootstrap-select.js') !!}

    <script>
        $(document).ready(function () {
            var mySelect = $('#first-disabled2');

            $('#special').on('click', function () {
                mySelect.find('option:selected').prop('disabled', true);
                mySelect.selectpicker('refresh');
            });

            $('#special2').on('click', function () {
                mySelect.find('option:disabled').prop('disabled', false);
                mySelect.selectpicker('refresh');
            });

            $('#basic2').selectpicker({
                liveSearch: true,
                maxOptions: 1
            });
        });
    </script>

    {!! Html::script('js/jquery.leanModal.min.js') !!}

    {!! Html::style('css/jquery.uls.css') !!}
    {!! Html::style('css/jquery.uls.grid.css') !!}
    {!! Html::style('css/jquery.uls.lcd.css') !!}

            <!-- Source -->
    {!! Html::script('js/jquery.uls.data.js') !!}
    {!! Html::script('js/query.uls.data.utils.js') !!}
    {!! Html::script('js/jquery.uls.lcd.js') !!}
    {!! Html::script('js/jquery.uls.languagefilter.js') !!}
    {!! Html::script('js/jquery.uls.regionfilter.js') !!}
    {!! Html::script('js/jquery.uls.core.js') !!}

    <script>
        $(document).ready(function () {
            $('.uls-trigger').uls({
                onSelect: function (language) {
                    var languageName = $.uls.data.getAutonym(language);
                    $('.uls-trigger').text(languageName);
                },
                quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
            });
        });
    </script>

    {!! Html::style('css/easy-responsive-tabs.css') !!}
    {!! Html::script('js/easyResponsiveTabs.js') !!}

</head>
<body>

<div class="header">
    <div class="container">
        <div class="logo">
            <a href="index.html"><span>IF</span>BA</a>
        </div>
        <div class="header-right">
            <a class="account" href="login.html">Gerenciar Conta</a>
            <span class="active uls-trigger">Gerenciar Semestre</span>
            <!-- Large modal -->

        </div>
    </div>
</div>

<nav id="menuHeader">
    <div class="banner text-center">
        <div class="container">
            <h1>Instituto Federal de Educação, Ciência e <span class="segment-heading">    Tecnologia da Bahia </span>
                Campus Eunápolis</h1>

            <p> Curso Tecnologia em Análise e Desenvolvimento de Sistemas</p>
            <a href="post-ad.html">Publicar Aviso</a>
        </div>
    </div>
</nav>

<!-- Categories -->
<!--Vertical Tab-->
<div class="categories-section main-grid-border">
    <div class="container">
        <h2 class="head">Menu Categorias</h2>

        <div class="category-list">
            <div id="parentVerticalTab">
                <ul class="resp-tabs-list hor_1">
                    <li>Avaliação</li>
                    <li><a href="disciplinas">Disciplinas</a></li>
                    <li><a href="professores">Docentes</a></li>
                    <li><a href="documentos">Documentos</a></li>
                    <a href="avisos">Consultar Avisos</a>
                </ul>
                <div class="resp-tabs-container hor_1">
                    <span class="active total" style="display:block;"><strong>PAINEL DE CONTROLE</strong> </span>

                    <div>
                        <div class="category">
                            <span class="semestre total" style="display:block;"><strong>Avaliações Semestrais</strong> </span>
                            <table>
                                <thead>
                                <tr>
                                    <th>Semestre</th>
                                    <th>Inicio</th>
                                    <th>Término</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="semestre">2014.1</td>
                                    <td class="semestre-inicio">24.02.2014</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre"> acao aqui</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2014.2</td>
                                    <td class="semestre-inicio">25.06.2014</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre">acao aqu</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2015.1</td>
                                    <td class="semestre-inicio">24.03.2015</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre">acao aqu</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2014.1</td>
                                    <td class="semestre-inicio">24.02.2014</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre"> acao aqui</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2014.2</td>
                                    <td class="semestre-inicio">25.06.2014</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre">acao aqu</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2015.1</td>
                                    <td class="semestre-inicio">24.03.2015</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre">acao aqu</td>
                                </tr>
                                <tr>
                                    <td class="semestre">2014.1</td>
                                    <td class="semestre-inicio">24.02.2014</td>
                                    <td class="semestre-fim">00.00.00</td>
                                    <td class="acao-semestre"> acao aqui</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <div>
                        <div class="category">
                            <div class="category-img">
                                <img src="images/cat2.png" title="image" alt=""/>
                            </div>
                            <div class="category-info">
                                <h4>Electronics & Appliances</h4>
                                <span>2,01,850 Ads</span>
                                <a href="all-classifieds.html">View all Ads</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="sub-categories">
                            <ul>
                                <li><a href="electronics-appliances.html">Computers & accessories</a></li>
                                <li><a href="electronics-appliances.html">Tv - video - audio</a></li>
                                <li><a href="electronics-appliances.html">Cameras & accessories</a></li>
                                <li><a href="electronics-appliances.html">Games & Entertainment</a></li>
                                <li><a href="electronics-appliances.html">Fridge - AC - Washing Machine</a></li>
                                <li><a href="electronics-appliances.html">Kitchen & Other Appliances</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="category">
                            <div class="category-img">
                                <img src="images/cat3.png" title="image" alt=""/>
                            </div>
                            <div class="category-info">
                                <h4>Cars</h4>
                                <span>1,98,080 Ads</span>
                                <a href="all-classifieds.html">View all Ads</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="sub-categories">
                            <ul>
                                <li><a href="cars.html">Commercial Vehicles</a></li>
                                <li><a href="cars.html">Other Vehicles</a></li>
                                <li><a href="cars.html">Spare Parts</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="category">
                            <div class="category-img">
                                <img src="images/cat4.png" title="image" alt=""/>
                            </div>
                            <div class="category-info">
                                <h4>Bikes</h4>
                                <span>6,17,568 Ads</span>
                                <a href="all-classifieds.html">View all Ads</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="sub-categories">
                            <ul>
                                <li><a href="bikes.html">Motorcycles</a></li>
                                <li><a href="bikes.html">Scooters</a></li>
                                <li><a href="bikes.html">Bicycles</a></li>
                                <li><a href="bikes.html">Spare Parts</a></li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--Plug-in Initialisation-->
<script type="text/javascript">
    $(document).ready(function () {

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<!-- //Categories -->
<!--footer section start-->
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="foo-grids">
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Quem somos nós</h4>

                    <p>Estudantes do IFBA, bla bla bla bla.</p>

                    <p>Estudantes do IFBA, bla bla bla bla.</p>
                </div>
                <div class="col-md-3 footer-grid">
                    <h4 class="footer-head">Contato</h4>
                    <span class="hq">Endereço</span>
                    <address>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-map-marker"></span></li>
                            <li> Av. David Jonas Fadini, 300 - Stela Reis, Eunápolis - BA, 45823-035</li>
                            <div class="clearfix"></div>
                        </ul>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-earphone"></span></li>
                            <li>(73) 3281-2266</li>
                            <div class="clearfix"></div>
                        </ul>
                        <ul class="location">
                            <li><span class="glyphicon glyphicon-envelope"></span></li>
                            <li><a href="mailto:info@example.com">email@decontato.com</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </address>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="footer-logo">
                <a href="index.html"><span>IF</span>BA</a>
            </div>
            <div class="footer-social-icons">
                <ul>
                    <li><a class="facebook" href="#"><span>Facebook</span></a></li>
                    <li><a class="twitter" href="#"><span>Twitter</span></a></li>
                    <li><a class="googleplus" href="#"><span>Google+</span></a></li>
                </ul>
            </div>
            <div class="copyrights">
                <p> © 2016 IFBA. Todos os direitos reservados </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>

<!--footer section end-->
</body>
</html>