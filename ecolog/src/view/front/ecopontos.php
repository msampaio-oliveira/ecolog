<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <header>
            <?php
            require_once "menu.php"; //_URLBASE_."src/view/front/menu.php"
            ?>
        </header>
        <div id="boxEcopontos">
            <h1>Ecopontos</h1>
            <div id="img-ecopontos480">
                <img class="ientulho" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_entulho480.png" alt=""/>
                <img class="ieletrodomesticos" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_eletrodomesticos480.png" alt=""/>
                <img class="ipilhas" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_pilha480.png" alt=""/>
                <img class="ieletronicos" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_eletronicos480.png" alt=""/>
                <img class="imoveis" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_moveis480.png" alt=""/>
                <img class="ioleo" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_oleo480.png" alt=""/>
                <img class="ibateria" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_bateria480.png" alt=""/>
            </div>

            <div id="img-ecopontos768">
                <img class="ientulho768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_entulho768.png" alt=""/>    
                <img class="ieletrodomesticos768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_eletrodomesticos768.png" alt=""/>
                <img class="ipilhas768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_pilha768.png" alt=""/>
                <img class="ieletronicos768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_eletronicos768.png" alt=""/>
                <img class="imoveis768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_moveis768.png" alt=""/>
                <img class="ioleo768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_oleo768.png" alt=""/>
                <img class="ibateria768" src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_bateria768.png" alt=""/>
            </div>
        </div>
    </body>

</html>

