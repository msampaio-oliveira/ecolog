<?php
$tipoUsuarioController = new Controller\TipoUsuarioController($conection);
?>
<section class="<?php echo $tipoUsuarioController->getLista(); ?>">
    <table>
        <caption>Lista de Tipo Usuario</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $tipoUsuarioController->listarTiposContatos();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroTipoUsuario&acao=1'" value="Novo">
</section>

<section class="<?php echo $tipoUsuarioController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Tipo Usuário</h4>
        <input type="hidden" name="txtCodTipoUsuario" id="txtCodTipoUsuario" value="<?php echo $tipoUsuarioController->getTipoUsuario()->getCodTipoUsuario(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $tipoUsuarioController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtNomeTipoUsuario" id="txtNomeTipoUsuario" value="<?php echo $tipoUsuarioController->getTipoUsuario()->getNomeTipoUsuario(); ?>" onblur="verificaTipoUsuario('<?php echo _URLBASE_.'tipoUsuarioAjax.php'?>', 'nomeTipoUsuario=' + this.value)" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroTipoUsuario">Voltar</a>
</section>


