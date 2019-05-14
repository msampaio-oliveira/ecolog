<?php
$usuarioController = new Controller\UsuarioController($conection);
$tipoUsuarioDAO = new Model\TipoUsuarioDAO($conection);
$tiposUsuarios = json_decode($tipoUsuarioDAO->selectAll(), true);

$tipoDocumentoDAO = new Model\TipoDocumentoDAO($conection);
$tiposDocumentos = json_decode($tipoDocumentoDAO->selectAll(), true);

$usuarioController->verificaTipoAcao();
?>
<section class="<?php echo $usuarioController->getLista(); ?>">
    <table>
        <caption>Lista de Usuarios</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Documento</th>
                <th>CEP</th>
                <th>Tipo Usuário</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $usuarioController->listarUsuarios();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroUsuario&acao=1'" value="Novo">
</section>

<section class="<?php echo $usuarioController->getFomulario(); ?>">
    <form method="POST" action="" enctype="multipart/form-data">
        <h4 class="cadCat">Cadastro de Usuário</h4>
        <input type="hidden" name="txtCodUsuario" id="txtCodUsuario" value="<?php echo $usuarioController->getUsuario()->getCodUsuario(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $usuarioController->getAcaoGET(); ?>" >
         <input type="hidden" name="txtFotoSalva" id="txtFotoSalva" value="<?php echo $usuarioController->getUsuario()->getUrlFotoUsuario(); ?>">
         
        <label>Nome</label><input type="text" class="grande" name="txtNomeUsuario" id="txtNomeUsuario" value="<?php echo $usuarioController->getUsuario()->getNomeUsuario(); ?>" required/><br>
        <label>Tipo</label>
        <select class="grande" name="txtCodTipoUsuario">
            <?php
            foreach ($tiposUsuarios as $tipoUsuario) {
                $selected = "";

                if ($tipoUsuario[0] == $usuarioController->getUsuario()->getCodTipoUsuario()) {
                    $selected = "selected";
                }

                echo "<option value = $tipoUsuario[0] $selected >$tipoUsuario[1]</option>";
            }
            ?>

        </select><br>
        <label>Foto</label>
        <input name="arquivo"  type="file" <?php echo $usuarioController->getUsuario()->getUrlFotoUsuario(); ?>/><br>
        <label>Login</label><input type="text" class="grande" name="txtLoginUsuario" id="txtLoginUsuario" value="<?php echo $usuarioController->getUsuario()->getLoginUsuario(); ?>" onblur="verificaLogin('<?php echo _URLBASE_ . 'usuarioAjax.php' ?>', 'login=' + this.value)" required/><br>
        <?php
        $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
        if ($acao != 2) {
            echo "<label>Senha</label><input type='password' class='grande' name='txtSenhaUsuario' id='txtSenhaUsuario' value='' required/><br>";
        }
        ?>
        
        <label>Tipo Documento</label>
        <select class="grande" name="txtCodTipoDocumento">
            <?php
            foreach ($tiposDocumentos as $tipoDocumento) {
                $selected = "";

                if ($tipoDocumento[0] == $usuarioController->getUsuario()->getCodTipoDocumento()) {
                    $selected = "selected";
                }

                echo "<option value = $tipoDocumento[0] $selected >$tipoDocumento[1]</option>";
            }
            ?>

        </select><br>
        <label>Documento</label><input type="text" class="grande"  name="txtDocUsuario" id="txtDocUsuario" value="<?php echo $usuarioController->getUsuario()->getDocUsuario(); ?>" onblur="verificaDocumento('<?php echo _URLBASE_ . 'usuarioAjax.php' ?>', 'documento=' + this.value)" required/><br>
        <label>CEP</label><input type="text" class="grande"  name="txtCep" id="txtCep" onblur="getAddress()" value="<?php echo $usuarioController->getUsuario()->getCepUsuario(); ?>" required/><br>
        <label>Estado</label><input type="text" class="grande" name="txtEstado" id="txtEstado" required/><br>
        <label>Cidade</label><input type="text" class="grande" name="txtCidade" id="txtCidade" required/><br>
        <label>Bairro</label><input type="text" class="grande" name="txtBairro" id="txtBairro" required/><br>
        <label>Endereço</label><input type="text" class="grande" name="txtEndereco" id="txtEndereco" required/> <br>
        <label>Número</label><input type="text" class="grande" name="txtNumero" id="txtNumero" value="<?php echo $usuarioController->getUsuario()->getNumUsuario(); ?>" required><br>
        <label>Complemento</label><input type="text" class="grande"  name="txtComplementoUsuario" id="txtComplementoUsuario" value="<?php echo $usuarioController->getUsuario()->getComplementoUsuario(); ?>"/><br>
        <label>Longitude</label><input type="text" class="grande" name="txtLongitude" id="txtLongitude" required/><br>
        <label>Latitude</label><input type="text" class="grande" name="txtLatitude" id="txtLatitude" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroUsuario">Voltar</a>
</section>

<script>
    document.addEventListener('load', preecheFormulario());
</script>

