<?php
$usuarioController = new Controller\UsuarioController($conection);
$tipoUsuarioDAO = new Model\TipoUsuarioDAO($conection);
$tiposUsuarios = json_decode($tipoUsuarioDAO->selectAll(), true);

$tipoDocumentoDAO = new Model\TipoDocumentoDAO($conection);
$tiposDocumentos = json_decode($tipoDocumentoDAO->selectAll(), true);

$usuarioController->verificaTipoAcao();

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

        <!--Validação-->
        <script src="<?php echo _URLBASE_; ?>public/js/validations.js"></script>
        <script src="<?php echo _URLBASE_; ?>public/js/filter.js"></script>
    </head>

    <body>
        <header>
            <div id="header480">
                <img id="img-cabecalho480"src="<?php echo _URLBASE_; ?>public/img/header_480.png" alt=""/>
                <img id="logo-eco480"src="<?php echo _URLBASE_; ?>public/img/icone_ecolog_480.png" alt=""/>
            </div>
            <div id="img-cabecalho768">
                <img id="img-cabecalho768"src="<?php echo _URLBASE_; ?>public/img/header_ecopontos768.png" alt=""/>
                <img id="logo-eco768"src="<?php echo _URLBASE_; ?>public/img/icone_ecopontos_768.png" alt=""/>
            </div>


            <?php
            require_once "menu.php"; //_URLBASE_."src/view/front/menu.php"
            ?>
        </header>

        <div id="boxCadastroUsuario">
            <h1>Cadastro</h1>
            <?php
            $src = _URLBASE_ . 'public/img/img_user.png';
            if ($valor) {
                $src = _URLBASE_ . $_SESSION['usuarioLogado']->URL_FOTO_USUARIO;
            }
            ?>
            <div id="img_cadastro_usuario"><img class="img_usuario" src="<?php echo $src ?>" alt="" /></div>
            <div class="login">

                <form action="" method="POST" class="configCadastro" enctype="multipart/form-data">
                    <fieldset>
                        <!---->
                        <input type="hidden" name="txtCodUsuario" id="txtCodUsuario" value="<?php echo $usuarioController->getUsuario()->getCodUsuario(); ?>">
                        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $usuarioController->getAcaoGET(); ?>" >
                        <input type="hidden" name="txtFotoSalva" id="txtFotoSalva" value="<?php echo $usuarioController->getUsuario()->getUrlFotoUsuario(); ?>">

                        <div class="campo">
                            <label>Nome</label>
                            <input type="text" class="tamanho-campo" name="txtNomeUsuario" id="txtNomeUsuario" placeholder="Digite seu nome completo" value="<?php echo $usuarioController->getUsuario()->getNomeUsuario(); ?>" required/>
                        </div>

                        <div class="campo">
                            <label>Tipo</label>
                            <select class="tamanho-campo" name="txtCodTipoUsuario">
                                <?php
                                foreach ($tiposUsuarios as $tipoUsuario) {
                                    $selected = "";

                                    if ($tipoUsuario[0] == $usuarioController->getUsuario()->getCodTipoUsuario()) {
                                        $selected = "selected";
                                    }


                                    echo "<option value = $tipoUsuario[0] $selected >$tipoUsuario[1]</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <div class="campo">
                            <label>Foto</label>
                            <input name="arquivo" class="tamanho-campo" type="file"/>
                        </div>

                        <div class="campo">
                            <label>E-mail</label>
                            <input type="text" class="tamanho-campo" name="txtLoginUsuario" id="txtLoginUsuario" value="<?php echo $usuarioController->getUsuario()->getLoginUsuario(); ?>" placeholder="Digite seu e-mail" onblur="verificaLogin('<?php echo _URLBASE_ . 'usuarioAjax.php' ?>', 'login=' + this.value)" required/>
                        </div>

                        <?php
                        $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
                        if ($acao != 2) {
                            echo "<div class='campo'><label>Senha</label><input type='password' class='tamanho-campo' name='txtSenhaUsuario' id='txtSenhaUsuario' value='' onblur=" . "\"validaSenha('txtSenhaUsuario')" . "\" placeholder='Digite sua senha' required/></div>";
                        }
                        ?>

                        <div class="campo">
                            <label>Tipo Documento</label>
                            <select class="tamanho-campo" id="txtCodTipoDocumento" name="txtCodTipoDocumento" onchange="adicionaValidacao()">
                                <option>Selecione o Tipo de Documento</option>
                                <?php
                                foreach ($tiposDocumentos as $tipoDocumento) {
                                    $selected = "";

                                    if ($tipoDocumento[0] == $usuarioController->getUsuario()->getCodTipoDocumento()) {
                                        $selected = "selected";
                                    }

                                    echo "<option value = $tipoDocumento[0] $selected >$tipoDocumento[1]</option>";
                                }
                                ?>

                            </select>
                        </div>

                        <div class="campo">
                            <label>Documento</label>
                            <input type="text" class="tamanho-campo"  name="txtDocUsuario" id="txtDocUsuario" value="<?php echo $usuarioController->getUsuario()->getDocUsuario(); ?>" placeholder="Digite seu documento de identificação" onblur="verificaDocumento('<?php echo _URLBASE_ . 'usuarioAjax.php' ?>', 'documento=' + this.value)" required/>
                        </div>

                        <div class="campo">
                            <label>CEP</label>
                            <input type="text" class="tamanho-campo"  name="txtCep" id="txtCep" onblur="getAddress()" value="<?php echo $usuarioController->getUsuario()->getCepUsuario(); ?>" placeholder="Digite seu CEP" onkeyup="mascara(this, mcep)" maxlength="9" required/>
                        </div>

                        <div class="campo">
                            <label>Estado</label>
                            <input type="text" class="tamanho-campo" name="txtEstado" id="txtEstado" placeholder="Digite seu estado" required/>
                        </div>

                        <div class="campo">
                            <label>Cidade</label>
                            <input type="text" class="tamanho-campo" name="txtCidade" id="txtCidade" placeholder="Digite sua cidade" required/>
                        </div>

                        <div class="campo">
                            <label>Bairro</label>
                            <input type="text" class="tamanho-campo" name="txtBairro" id="txtBairro" placeholder="Digite seu bairro" required/>
                        </div>

                        <div class="campo">
                            <label>Endereço</label>
                            <input type="text" class="tamanho-campo" name="txtEndereco" id="txtEndereco" placeholder="Digite seu endereço" required/> 
                        </div>

                        <div class="campo">
                            <label>Número</label>
                            <input type="text" class="tamanho-campo" name="txtNumero" id="txtNumero" value="<?php echo $usuarioController->getUsuario()->getNumUsuario(); ?>" placeholder="Digite seu número" required>
                        </div>

                        <div class="campo">
                            <label>Complemento</label>
                            <input type="text" class="tamanho-campo"  name="txtComplementoUsuario" id="txtComplementoUsuario" value="<?php echo $usuarioController->getUsuario()->getComplementoUsuario(); ?>" placeholder="Digite o complemento"/>
                        </div>

                        <div class="campo">
                            <label>Longitude</label>
                            <input type="text" class="tamanho-campo" name="txtLongitude" id="txtLongitude" placeholder="Digite sua longitude" required/>
                        </div>

                        <div class="campo">
                            <label>Latitude</label>
                            <input type="text" class="tamanho-campo" name="txtLatitude" id="txtLatitude" placeholder="Digite sua latitude" required/>
                        </div>


                        <?php
                        $cod = $usuarioController->getUsuario()->getCodUsuario();

                        if ($cod != "" || $cod != null || $cod != 0) {
                            echo "<button class = 'botao-senha' type = 'button' name = 'alterarSenha'><a href='" . _URLBASE_ . "index.php?area=alteracao&acao=7&id=" . $_SESSION['usuarioLogado']->COD_USUARIO . "'>Alterar Senha</a></button>";
                        }
                        ?>

                        <button class="botao" type="submit" name="submit">Salvar</button>

                        <?php
                        if ($cod != "" || $cod != null || $cod != 0) {

                            echo "<button class = 'botao-remover' type = 'button' name = 'excluir' onclick = 'confirm()'>Excluir Conta</button>";
                        }
                        ?>
                    </fieldset>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('load', preecheFormulario());
        </script>
        <?php
        $mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : null;

        if ($mensagem === "sucesso") {
            echo "<script>document.addEventListener('load', toastSuccessFront('Sucesso!', 'Senha alterada com sucesso!'))</script>";
        }
        ?>
        <script>
            criaFunc();
        </script>
    </body>
</html>

