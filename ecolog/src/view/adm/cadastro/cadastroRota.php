<?php
$rotaController = new Controller\RotaController($conection);

$usuarioDAO = new Model\UsuarioDAO($conection);
$usuarios = json_decode($usuarioDAO->selectAll(), true);
?>

<script src="<?php echo _URLBASE_;?>public/js/LocationManagerRota.js"></script>
<section class="<?php echo $rotaController->getLista(); ?>">
    <table>
        <caption>Lista de Rotas</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>CEP Inicio</th>
                <th>CEP Fim </th>
                <th>Usuário</th>
                <th>Observação</th>
                <th>Data Cadastro</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $rotaController->listarRotas();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroRota&acao=1'" value="Novo">
</section>



<section class="<?php echo $rotaController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Rotas</h4>
        <input type="hidden" name="txtCodRota" id="txtCodRota" value="<?php echo $rotaController->getRota()->getCodRota(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $rotaController->getAcaoGET(); ?>" >

        <label>CEP Inicial</label><input type="text" class="grande" name="txtCepInicialRota" id="txtCepInicialRota" value="<?php echo $rotaController->getRota()->getCepInicialRota(); ?>" onblur="getAddressInicial()" required /><br>
        <label>Estado</label><input type="text" class="grande" name="txtEstadoInicial" id="txtEstadoInicial" required/><br>
        <label>Cidade</label><input type="text" class="grande" name="txtCidadeInicial" id="txtCidadeInicial" required/><br>
        <label>Bairro</label><input type="text" class="grande" name="txtBairroInicial" id="txtBairroInicial" required/><br>
        <label>Endereço</label><input type="text" class="grande" name="txtEnderecoInicial" id="txtEnderecoInicial" required/> <br>
        <label>Longitude</label><input type="text" class="grande" name="txtLongitudeInicialRota" id="txtLongitudeInicialRota" value="<?php echo $rotaController->getRota()->getLongitudeInicialRota(); ?>" required/><br>
        <label>Latitude</label><input type="text" class="grande" name="txtLatitudeInicialRota" id="txtLatitudeInicialRota" value="<?php echo $rotaController->getRota()->getLatitudeInicialRota(); ?>" required/><br>

        <label>CEP Final</label><input type="text" class="grande" name="txtCepFinalRota" id="txtCepFinalRota" value="<?php echo $rotaController->getRota()->getCepFinalRota(); ?>" onblur="getAddressFinal()" required/><br>
        <label>Estado</label><input type="text" class="grande" name="txtEstadoFinal" id="txtEstadoFinal" required/><br>
        <label>Cidade</label><input type="text" class="grande" name="txtCidadeFinal" id="txtCidadeFinal" required/><br>
        <label>Bairro</label><input type="text" class="grande" name="txtBairroFinal" id="txtBairroFinal" required/><br>
        <label>Endereço</label><input type="text" class="grande" name="txtEnderecoFinal" id="txtEnderecoFinal" required/> <br>
        <label>Longitude</label><input type="text" class="grande" name="txtLongitudeFinalRota" id="txtLongitudeFinalRota" value="<?php echo $rotaController->getRota()->getLongitudeFinalRota(); ?>" required/><br>
        <label>Latitude</label><input type="text" class="grande" name="txtLatitudeFinalRota" id="txtLatitudeFinalRota" value="<?php echo $rotaController->getRota()->getLatitudeFinalRota(); ?>" required/><br>

        <label>Observação</label><input type="text" class="grande" name="txtObsRota" id="txtObsRota" value="<?php echo $rotaController->getRota()->getObsRota(); ?>" required/><br>

        <label>Usuário</label>
        <select class="grande" name="txtCodUsuario" id="txtCodUsuario">
            <?php
            foreach ($usuarios as $usuario) {
                $selected = "";

                if ($usuario[0] == $rotaController->getRota()->getCodUsuario()) {
                    $selected = "selected";
                }

                echo "<option value = $usuario[0] $selected >$usuario[1]</option>";
            }
            ?>
        </select>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroRota">Voltar</a>
</section>

<script>
    document.addEventListener('load', preecheFormularioRota());
</script>
