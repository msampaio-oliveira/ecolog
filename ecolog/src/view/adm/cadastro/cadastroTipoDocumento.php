<?php
$tipoDocumentoController = new Controller\TipoDocumentoController($conection);
?>
<section class="<?php echo $tipoDocumentoController->getLista(); ?>">
    <table>
        <caption>Lista de Tipo Documento</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $tipoDocumentoController->listarTiposDocumento();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroTipoDocumento&acao=1'" value="Novo">
</section>

<section class="<?php echo $tipoDocumentoController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Tipo Documento</h4>
        <input type="hidden" name="txtCodTipoDocumento" id="txtCodTipoDocumento" value="<?php echo $tipoDocumentoController->getTipoDocumento()->getCodTipoDocumento(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $tipoDocumentoController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtNomeTipoDocumento" id="txtNomeTipoDocumento" value="<?php echo $tipoDocumentoController->getTipoDocumento()->getNomeTipoDocumento(); ?>" onblur="verificaTipoUsuario('<?php echo _URLBASE_.'tipoUsuarioAjax.php'?>', 'nomeTipoUsuario=' + this.value)" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroTipoDocumento">Voltar</a>
</section>


