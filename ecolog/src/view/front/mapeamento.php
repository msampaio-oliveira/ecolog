<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang=pt-br>

    <head>
        <title></title>

        <meta charset=UTF-8>
        <!-- ISO-8859-1 -->
        <meta name=viewport content="width=device-width, initial-scale=1.0">
        <!-- não se deve travar o zoom-->
        <meta name=description content="">
        <!-- 360caracteres, porem com perdas após 160 caracteres-->
        <meta name=keywords content="">
        <!-- Opcional -->
        <meta name=author content=''>
        <meta name=application-name content=StackOverflow>

        <!-- favicon, arquivo de imagem podendo ser 8x8 - 16x16 - 32x32px com extensão .ico -->
        <link rel="shortcut icon" href="" type="image/x-icon">

        <!-- CSS PADRÃO -->
        <link href="<?php echo _URLBASE_; ?>public/css/style.css" rel="stylesheet" type="text/css"/>

        <!-- Telas Responsivas -->
        <link rel=stylesheet media="screen and (max-width:480px)" href="<?php echo _URLBASE_; ?>public/css/style_480.css">
        <link rel=stylesheet media="screen and (min-width:481px) and (max-width:768px)" href="<?php echo _URLBASE_; ?>public/css/style_768.css">
        <link rel=stylesheet media="screen and (min-width:769px) and (max-width:1024px)" href="<?php echo _URLBASE_; ?>public/css/style_1024.css">
        <link rel=stylesheet media="screen and (min-width:1366px)" href="<?php echo _URLBASE_; ?>public/css/style_1366.css">
        <!-- >Axure fixar em 1200 limite max -->
    </head>
    <body>
        <div>
            <img id="img-cabecalho480"src="<?php echo _URLBASE_; ?>public/img/header_480.png" alt=""/>
            <img id="logo-eco480"src="<?php echo _URLBASE_; ?>public/img/icone_ecolog_480.png" alt=""/>
        </div>
        <div id="img-cabecalho768">
            <img id="img-cabecalho768"src="<?php echo _URLBASE_; ?>public/img/header_ecopontos768.png" alt=""/>
            <img id="logo-eco768"src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_768.png" alt=""/>
        </div>
        <div id="img-cabecalho768">
            <img id="img-cabecalho768"src="<?php echo _URLBASE_; ?>public/img/header_ecopontos768.png" alt=""/>
            <img id="logo-eco768"src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_768.png" alt=""/>
        </div>
        <header>
            <?php
            require_once "menu.php"; //_URLBASE_."src/view/front/menu.php"
            ?>
        </header>
        <div id="boxMapeamento">
            <h1>Ecopontos</h1>
            <form action="" method="POST">
                <div id="centralizacaoForm">  
                    <div class="campoLocal">
                        <label for="local">Local atual</label>
                        <input type="text" name="txtUsuario" class=local value="" placeholder="Informe seu Local Atual">
                    </div>
                    <div class="campoDestino">
                        <label class="tDestino" for="destino">Destino</label>
                        <input class="destino" type="text" name="txtSenha" value="" placeholder="Informe seu Destino">
                    </div>
                </div>
            </form>
        </div>


        <h1>My First Google Map</h1>

        <div id="googleMap"></div>

        <script>
            function myMap() {
                var mapProp = {
                    center: new google.maps.LatLng(-23.5498051, -46.91602739999996),
                    zoom: 15,
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jIDGCxroPfUVdJzAGqKgnSGzy55jleg&callback=myMap"></script>

    </body>
</html>