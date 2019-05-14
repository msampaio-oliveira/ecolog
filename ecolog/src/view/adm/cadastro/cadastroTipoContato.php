<?php
$tipoContatoController = new Controller\TipoContatoController($conection);
?>
<section class="<?php echo $tipoContatoController->getLista(); ?>">
    <table>
        <caption>Lista de Tipo Contato</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $tipoContatoController->listarTiposContatos();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroTipoContato&acao=1'" value="Novo">
</section>

<section class="<?php echo $tipoContatoController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Tipo Contato</h4>
        <input type="hidden" name="txtCodTipoContato" id="txtCodTipoContato" value="<?php echo $tipoContatoController->getTipoContato()->getCodTipoContato(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $tipoContatoController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtDescTipoContato" id="txtDescTipoContato" value="<?php echo $tipoContatoController->getTipoContato()->getDescContato(); ?>" onblur="verificaTipoContato('<?php echo _URLBASE_.'tipoContatoAjax.php'?>', 'nomeTipoContato=' + this.value)" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroTipoContato">Voltar</a>
</section>


