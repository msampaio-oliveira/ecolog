<?php
$usuarioController = new Controller\UsuarioController($conection);
?>
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

        <!-- Endereço -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>/public/js/LocationManager.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jIDGCxroPfUVdJzAGqKgnSGzy55jleg"
        async defer></script>

        <!-- Toast -->
        <link rel="stylesheet"  href="<?php echo _URLBASE_; ?>public/css/jquery.toast.min.css">
        <script src="<?php echo _URLBASE_; ?>public/js/jquery.toast.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/toast.js"></script>

        <!-- Ajax -->
        <script src="<?php echo _URLBASE_; ?>public/js/funcoes.js"></script>

        <!-- Confirm -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    </head>

    <body>
        <header>

            <div id="header480">
                <img id="img-cabecalho480" src="<?php echo _URLBASE_; ?>public/img/header_480.png" alt=""/>
                <img id="logo-eco480" src="<?php echo _URLBASE_; ?>public/img/icone_ecolog_480.png" alt=""/>
            </div>
            <div id="img-cabecalho768">
                <img id="img-cabecalho768"src="<?php echo _URLBASE_; ?>public/img/header_ecopontos768.png" alt=""/>
                <img id="logo-eco768"src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_768.png" alt=""/>
            </div>

            <?php
            require_once "menu.php" ;//_URLBASE_."src/view/front/menu.php"
            ?>
        </header>

        <div id="boxEsqueceuSenhaUsuario">
            <h1>Recuperar Senha</h1>

            <div class="login">

                <form action="" method="POST" class="configEsqueceuSenha">
                    <fieldset>
                        <input type="hidden" name="txtAcao" id="txtAcao" value="4" >

                        <div class="campo">
                            <label>E-mail</label>
                            <input type="text" placeholder="Informe seu usuário" class="tamanho-campo" name="txtEmailUsuario" id="txtEmailUsuario" required>
                        </div>

                        <button class="botao ajusteBotaoAlterarSenha" type="submit" name="submit">Salvar</button>
                    </fieldset>
                </form>
            </div>
        </div>


    </body>

</html>

