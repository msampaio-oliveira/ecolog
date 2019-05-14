<?php
$hash = isset($_GET['hash']) ? $_GET['hash'] : null;
$dataGeracao = isset($_GET['data']) ? $_GET['data'] : null;

if ($hash == null || $dataGeracao == null) {
    header("Location: " . _URLBASE_ . "index.php");
}

$data = str_replace(".", " ", $dataGeracao);
$hashSenha = new Model\HashSenha();
$hashSenha->setHashSenha($hash);
$hashSenha->setDataGeracao($data);
$hashSenhaDAO = new Model\HashSenhaDAO($conection);

$value = $hashSenhaDAO->selectHash($hashSenha);

if ($value == null) {
    header("Location: " . _URLBASE_ . "index.php");
}

$dataBanco = new DateTime($value->getDataGeracao()); //era data 1
$dataAtual = new DateTime(date('Y/m/d H:i:s')); // data data 2

$dataGeracaoConvertida = $dataBanco->format('Y-m-d H:i:s');
$dataAtualConvertida = $dataAtual->format('Y-m-d H:i:s');

$diff = $dataBanco->diff($dataAtual);
$horas = $diff->h + ($diff->days * 24);

if ($horas > 24) {
    header("Location: " . _URLBASE_ . "index.php?mensagem=expirado");
}

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
            require_once "menu.php"; //_URLBASE_."src/view/front/menu.php"
            ?>
        </header>

        <div id="boxRecuperarSenhaUsuario">
            <h1>Recuperar Senha</h1>

            <div class="login">

                <form action="" method="POST" class="configRecuperarSenha">
                    <fieldset>
                        <input type="hidden" name="txtAcao" id="txtAcao" value="5" >
                        <input type="hidden" name="txtCodUsuario" id="txtCodUsuario" value="<?php echo $value->getCodUsuario() ?>" >
                        
                        <div class="campo">
                            <label>Nova Senha:</label>
                            <input type="password" class="tamanho-campo" name="txtSenhaUsuarioNova" id="txtSenhaUsuarioNova" required>
                        </div>

                        <div class="campo">
                            <label>Confirmar Senha:</label>
                            <input type="password" class="tamanho-campo" name="txtSenhaUsuarioNovaConfirmacao" id="txtSenhaUsuarioNovaConfirmacao" onblur="verificaSenha()" required>
                        </div>

                        <button class="botao ajusteBotaoAlterarSenha" type="submit" name="submit">Salvar</button>
                    </fieldset>
                </form>
            </div>
        </div>


    </body>

</html>

