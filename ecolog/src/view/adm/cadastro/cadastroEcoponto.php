<?php
$ecopontoController = new Controller\EcopontoController($conection);
?>

<section class="<?php echo $ecopontoController->getLista(); ?>">
    <table>
        <caption>Lista de Ecopontos</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Funcionamento</th>
                <th>CEP</th>
                <th>Número</th>
                <th>Complemento</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $ecopontoController->listarEcopontos();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroEcoponto&acao=1'" value="Novo">
</section>



<section class="<?php echo $ecopontoController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Ecoponto</h4>
        <input type="hidden" name="txtCodEcoponto" id="txtCodEcoponto" value="<?php echo $ecopontoController->getEcoponto()->getCodEcoponto(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $ecopontoController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtNomeEcoponto" id="txtNomeEcoponto" value="<?php echo $ecopontoController->getEcoponto()->getNomeEcoponto(); ?>" required/><br>
        <label>Funcionamento</label><input type="text" class="grande" name="txtHorarioFuncEcoponto" id="txtHorarioFuncEcoponto" value="<?php echo $ecopontoController->getEcoponto()->getHorarioFuncEcoponto(); ?>" required/><br>

        <label>CEP</label><input type="text" class="grande"  name="txtCep" id="txtCep" onblur="getAddress()" value="<?php echo $ecopontoController->getEcoponto()->getCepEcoponto(); ?>" required/><br>
        <label>Estado</label><input type="text" class="grande" name="txtEstado" id="txtEstado" required/><br>
        <label>Cidade</label><input type="text" class="grande" name="txtCidade" id="txtCidade" required/><br>
        <label>Bairro</label><input type="text" class="grande" name="txtBairro" id="txtBairro" required/><br>
        <label>Endereço</label><input type="text" class="grande" name="txtEndereco" id="txtEndereco" required/> <br>
        <label>Número</label><input type="text" class="grande" name="txtNumero" id="txtNumero" value="<?php echo $ecopontoController->getEcoponto()->getNumEcoponto(); ?>" required><br>
        <label>Complemento</label><input type="text" class="grande"  name="txtComplementoEcoponto" id="txtComplementoEcoponto" value="<?php echo $ecopontoController->getEcoponto()->getComplementoEcoponto(); ?>"/><br>
        <label>Longitude</label><input type="text" class="grande" name="txtLongitude" id="txtLongitude" value="<?php echo $ecopontoController->getEcoponto()->getLongitudeEcoponto(); ?>" required/><br>
        <label>Latitude</label><input type="text" class="grande" name="txtLatitude" id="txtLatitude" value="<?php echo $ecopontoController->getEcoponto()->getLatitudeEcoponto(); ?>" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroEcoponto">Voltar</a>
</section>

<script>
    document.addEventListener('load', preecheFormulario());
</script>

