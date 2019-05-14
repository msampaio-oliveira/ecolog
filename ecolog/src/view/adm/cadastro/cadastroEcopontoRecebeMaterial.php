<?php
$ecopontoRecebeMaterialController = new Controller\EcopontoRecebeMaterialController($conection);

// Selecionando todos os ecopontos
$ecopontoDao = new Model\EcoPontoDAO($conection);
$listaEcopontos = json_decode($ecopontoDao->selectAll(), true);

?>

<section class="<?php echo $ecopontoRecebeMaterialController->getLista()?>">
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
                <th>Material</th>
                <th>Tipo</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $ecopontoRecebeMaterialController->listarEcopontoRecebeMateriais();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroEcopontoRecebeMaterial&acao=1'" value="Novo">
</section>



<section class="<?php echo $ecopontoRecebeMaterialController->getFomulario()?>">
    <form method="POST" action="">
        <h4 class="cadCat">Ecoponto Recebe Material</h4>
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $ecopontoRecebeMaterialController->getAcaoGET(); ?>" >

        <div style="  display: flex; flex-direction: row; justify-content: center; align-items: center">
            <div style="margin-right: 15px;">
                <label>Código</label><input type="text" class="grande" name="txtCodEcopontoExibicao" id="txtCodEcopontoExibicao" value="<?php echo $ecopontoRecebeMaterialController->getEcopontoRecebeMaterial()->getCodEcoponto(); ?>" disabled/><br>
                <label>Nome</label><input type="text" class="grande" name="txtNomeEcopontoExibicao" id="txtNomeEcopontoExibicao" value="<?php echo $ecopontoRecebeMaterialController->getEcopontoRecebeMaterial()->getNomeEcoponto(); ?>" disabled/><br>

                <select id="txtCodEcoponto" name="txtCodEcoponto" onchange="recuperarEcopontoMaterial('http://localhost/ecolog/src/util/selecionarEcopontoMaterialAjax.php', 'codEcoponto=' + this.value, 'txtCodEcopontoExibicao', 'txtNomeEcopontoExibicao')">

                    <option value="0">Selecione o Ecoponto</option>
                    <?php
                    $selected = "";
                    foreach ($listaEcopontos as $ecoponto) {
                        if($ecoponto[0] == $ecopontoRecebeMaterialController->getEcopontoRecebeMaterial()->getCodEcoponto) {
                            $selected = "selected";
                        }
                        echo "<option value=$ecoponto[0] $selected>$ecoponto[1]</option>";
                    }
                    ?>
                </select>
            </div>
            <div style=" ">
                <label>Código</label><input type="text" class="grande" name="txtCodMaterial" id="txtCodMaterialExibicao" value="<?php echo $ecopontoRecebeMaterialController->getEcopontoRecebeMaterial()->getCodEcoponto(); ?>" disabled/><br>
                <label>Nome</label><input type="text" class="grande" name="txtNomeMaterial" id="txtNomeMaterialExibicao" value="<?php echo $ecopontoRecebeMaterialController->getEcopontoRecebeMaterial()->getNomeEcoponto(); ?>" disabled/><br>

                <select id="txtCodMaterial" name="txtCodMaterial" onclick="verificaSituacao('txtCodEcoponto')" onchange="recuperarEcopontoMaterial('http://localhost/ecolog/src/util/selecionarEcopontoMaterialAjax.php', 'codMaterial=' + this.value, 'txtCodMaterialExibicao', 'txtNomeMaterialExibicao')"> 

                    <option>Selecione o Material</option>
                    <?php
//                    foreach ($naorecebidos as $naoRecebido) {
//                        echo "<option value=$naoRecebido[0]>$naoRecebido[1]</option>";
//                    }
//                    ?>
                </select>
            </div>
        </div>
        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroEcoponto">Voltar</a>
</section>

