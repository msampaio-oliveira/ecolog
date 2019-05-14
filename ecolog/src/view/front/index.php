<?php
$autenticadorController = new Controller\AutenticadorController($conection);
$valor = isset($_SESSION['usuarioLogado']) ? true : false;
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

        <!-- Toast -->
        <link rel="stylesheet"  href="<?php echo _URLBASE_; ?>public/css/jquery.toast.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/jquery.toast.min.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/toast.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/funcoes.js"></script>

        <script>
            window.onload = function () {
                var resolucao = window.innerWidth;
                if (resolucao >= 768) {
                    document.getElementById("bv").innerHTML = "Bem Vindo";
                } else {
                    document.getElementById("bv").innerHTML = "Bem Vindo a Ecolog";
                }
            }
        </script>

    </head>

    <body>
        <a href="#boxLogin" id="btn-login"></a>
        <header>
            <?php
            require_once "menu.php"; //_URLBASE_."src/view/front/menu.php"
            ?>
        </header>
        <!------------------------------------------------------------------ IMAGENS DE FUNDO ------------------------------------------------->        

        <figure id="img_480" id="img_fundo480">
            <img src="<?php echo _URLBASE_; ?>public/img/img_fundo480.jpg" alt=""/>
        </figure>
        <figure id="logo_480">
            <img src="<?php echo _URLBASE_; ?>public/img/logo_ecolog480.png" alt=""/>
        </figure>



        <figure id="img_768">
            <img src="<?php echo _URLBASE_; ?>public/img/img_fundo768.jpg" alt=""/>
        </figure>
        <figure id="logo_768">
            <img src="<?php echo _URLBASE_; ?>public/img/logo_ecolog768.png" alt=""/>
        </figure>






        <!------------------------------------------------------------------ FIM DE IMAGENS ------------------------------------------------->

        <h1 id="bv">Bem-vindo a Ecolog</h1>
        <h1 id="bv2">Encontre o ecoponto mais</h1>
        <h1 id="bv3">próximo</h1>
        <figure id="local_480">
            <a href="<?php echo _URLBASE_;?>index.php?area=ecopontos"><img src="<?php echo _URLBASE_; ?>public/img/Localizacao_ecolog_480.png" alt=""/></a>
        </figure>


        <div id="boxVenda">
            <h1>Vendas</h1>
            <p>Trabalhamos com a divulgação de locais para comercialização de materiais reciclaveis.<br>
                Na página venda é possível verificar algumas informações, como produto, preço e valor para compra dos materiais.</p>

            <div id="img_venda480">
                <img id="iPapel" src="<?php echo _URLBASE_; ?>public/img/icone_venda_papel480.png" alt=""/>
                <img id="iPlastico" src="<?php echo _URLBASE_; ?>public/img/icone_venda_plastico480.png" alt=""/>
                <img id="iVidro" src="<?php echo _URLBASE_; ?>public/img/icone_venda_vidro480.png" alt=""/>
                <img id="iMetal" src="<?php echo _URLBASE_; ?>public/img/icone_venda_metal480.png" alt=""/>
                <img id="iOrganico" src="<?php echo _URLBASE_; ?>public/img/icone_venda_organico480.png" alt=""/>
            </div>
            <div id="img_venda768">
                <img id="iPapel" src="<?php echo _URLBASE_; ?>public/img/icone_venda_papel768.png" alt=""/>
                <img id="iPlastico" src="<?php echo _URLBASE_; ?>public/img/icone_venda_plastico768.png" alt=""/>
                <img id="iPlastico" src="<?php echo _URLBASE_; ?>public/img/icone_venda_vidro768.png" alt=""/>
                <img id="iMetal" src="<?php echo _URLBASE_; ?>public/img/icone_venda_metal768.png" alt=""/>
                <img id="iOrganico" src="<?php echo _URLBASE_; ?>public/img/icone_venda_organico768.png" alt=""/>
            </div>
        </div>

        <div id="boxDicas">
            <h1>Dicas</h1>
            <p>Em dicas disponibilizaremos informações relacionadas a
                sustentabilidade, exemplo seleção de materiais recicláveis,
                reaproveitamento de materiais recicláveis, formas de
                armazenamento de lixo, ou seja, pequenas ações para
                facilidade e economia em seu cotidiano. </p>

            <div id="img_dicas">
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_torneira480.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_lampada480.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_organico480.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_residuos480.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_carbono480.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_casa480.png" alt=""/>
            </div>
            <div id="img_dicas768">
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_torneira768.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_lampada768.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_organico768.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_residuos768.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_carbono768.png" alt=""/>
                <img src="<?php echo _URLBASE_; ?>public/img/icone_dicas_casa768.png" alt=""/>
                <div id="teste"></div>
            </div>
        </div>
        <div id="boxBolsa">
            <h1>Bolsa de Valores</h1>
            <p>Permite a visualização dos dados e as projeções
                numéricas através de gráficos, que representam a
                variação monetária dos produtos de determinadas
                categorias, para otimização de ganhos. </p>
            <div id="img_bolsa480">
                <img src="<?php echo _URLBASE_; ?>public/img/grafico_bolsa480.png" alt=""/>
            </div>
            <div id="img_bolsa768">
                <img src="<?php echo _URLBASE_; ?>public/img/grafico_bolsa768.png" alt=""/>
            </div>
        </div>

        <div id="boxLogin">
            <h1>Login</h1>
            <div id="img_login480"><img src="<?php echo _URLBASE_ . 'public/img/user_login_480.png' ?>" alt="" style="width: 85px; height: 85px; border-radius: 50px;    "/></div>
            <div id="img_login768"><img src="<?php echo _URLBASE_; ?>public/img/user_login_768.png" alt=""/></div>
            <div class="login">

                <form action="" method="POST" class="config">
                    <fieldset>
                        <div class="campo">
                            <label for="email">E-mail</label>
                            <input type="text" id="txtEmailUsuario" name="txtEmailUsuario" class="tamanho-campo" value="<?php echo isset($_SESSION['ultimoLogin']) ? $_SESSION['ultimoLogin'] : ''?>" onblur="validaEmail('txtEmailUsuario')" placeholder="Informe seu e-mail" required>
                        </div>
                        <div class="campo">
                            <label for="senha">Senha</label>
                            <input type="password" id="txtSenha" name="txtSenha" class="tamanho-campo" value="" placeholder="Informe sua senha" required>
                        </div>

                        <button class="botao" type="submit" name="submit">Login</button>

                        <div class="campo info">
                            <label class="esqueceu"><a href="index.php?area=esqueceuSenha">Esqueceu a senha?</a></label>
                        </div>

                        <div class="campo info">
                            <label><a href="index.php?area=cadastro&acao=1&login=1">Criar conta</a></label>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <a href="<?php echo _URLBASE_ . '?area=cadastro&acao=2&login=1&id=' . $_SESSION['usuarioLogado']->COD_USUARIO ?>">

            <div id="boxInformacoes" style="display: <?php echo $valor ? 'block' : 'none' ?>">
                <?php
                $src = _URLBASE_ . 'public/img/img_user.png';

                if ($valor) {
                    $src = _URLBASE_ . $_SESSION['usuarioLogado']->URL_FOTO_USUARIO;
                }
                ?>
                <h1>Perfil</h1>
                <p>Seja bem vindo(a) <?php echo $_SESSION['usuarioLogado']->NOME_USUARIO ?>,
                    aqui você pode alterar suas informações cadastrais, senha e até excluir sua conta.</p>
                <div id="img_perfil">
                    <div><img src="<?php echo $src ?>" alt="" style="width: 150px; height: 150px; border-radius: 100px;    "/></div>
                </div>
            </div>
        </a>

        <div id="boxEcolog">
            <h1>Ecolog</h1>
            <p>Permite a visualização dos dados e as projeções 
                numéricas através de gráficos, que representam a
                variação monetária dos produtos de determinadas
                categorias, para otimização de ganhos. </p>
            <div id="img_ecolog480">
                <img src="<?php echo _URLBASE_; ?>public/img/icone_ecolog_480.png" alt=""/>
            </div>
            <div id="img_ecolog768">
                <img src="<?php echo _URLBASE_; ?>public/img/icone_ecolog_768.png" alt=""/>
            </div>
        </div>
        <div id="boxFaleConosco">
            <h1>Fale Conosco</h1>
            <form action="<?php echo _URLBASE_ ?>src/util/Email.php" method="POST" class="mensagem">
                <fieldset class="grupo">
                    <div class="mCampo">
                        <label for="name">Nome</label>
                        <input class="campoInputN" type="text" id="txtName" name="txtName" value="" placeholder="Informe seu Nome" required>
                    </div>
                    <div class="mCampo">
                        <label for="email">E-mail</label>
                        <input class="campoInputE" type="text" id="txtUsuario" name="txtUsuario" value="" onblur="validaEmail('txtUsuario')" placeholder="Informe seu e-mail" required>
                    </div>
                    <label class="lAssunto" for="assunto">Assunto</label>
                    <div class="select">
                        <select name="txtAssunto" required>
                            <option value="">Selecione o assunto</option>
                            <option value="Elogio">Elogio</option>
                            <option value="Sugestao">Sugestão</option>
                            <option value="Reclamacao">Reclamação</option>
                        </select>
                    </div>
                    <label class="Lmensagem">Mensagem:</label>
                    <div class="msg">
                        <textarea class="textArea" name="txtMensagem" rows="4" cols="50" required></textarea>
                        <button class="enviarM" type="submit" name="submit">Enviar</button>
                    </div>
                </fieldset>
            </form>
        </div>


    </body>

</html>
<?php
$autenticadorController->autenticarUsuario();

$parametro = isset($_GET['mensagem']) ? $_GET['mensagem'] : null;
echo $parametro;
if ($parametro != null) {
    if ($parametro == "email") {
        echo "<script>document.addEventListener('load', toastSuccessFront('Obrigado!', 'E-mail enviado com sucesso!'))</script>";
    } else if ($parametro == "cadastro") {
        echo "<script>efetuarLogin('"._URLBASE_."src/util/efetuarLoginAjax.php', 'txtEmailUsuario=" . $_SESSION['login'] . "&txtSenha=" . $_SESSION['senha'] . "')</script>";
    } else if ($parametro == "login") {
        echo "<script> document.getElementById('btn-login').click();</script>";
    } else if ($parametro == "redefinição") {
        echo "<script>document.addEventListener('load', toastSuccessFront('Enviado com sucesso!', 'Para finalizar o processo de redefinição da senha, o link para redefinir sua senha foi enviado para o seu e-mail.'))</script>";
    } else if ($parametro == "expirado") {
        echo "<script>document.addEventListener('load', toastrErrorFront('Link expirado!', 'O link para redefinir sua senha não é mais válido, por favor solicite um novo.'))</script>";
    } else if ($parametro == "sucesso") {
        echo "<script>document.addEventListener('load', toastSuccessFront('Recuperação efetuada!', 'Senha recuperada com sucesso.'))</script>";
    }
}
?>