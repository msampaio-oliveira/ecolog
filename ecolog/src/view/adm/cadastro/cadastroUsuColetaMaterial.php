<?php

$idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : null;

$usuColetaMaterialController = new Controller\UsuColetaMaterialController($conection);

$usuarioDAO = new Model\UsuarioDAO($conection);
$usuario = new Model\Usuario();
$usuario->setCodUsuario($idUsuario);
$usuColetaMaterialController->setUsuColetaMAterial($usuarioDAO->selectId($usuario));

?>
<section class="on">
    <form method="POST" action="">
        <h4 class="cadCat">Usuário Coleta Material</h4>
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo 2 ?>" >

        <div style="  display: flex; flex-direction: row; justify-content: center; align-items: center">
            <div style="margin-right: 15px;">
                <label>Código</label><input type="text" class="grande" name="txtCodUsuarioExibicao" id="txtCodUsuarioExibicao" value="<?php echo $usuColetaMaterialController->getUsuColetaMAterial()->getCodUsuario(); ?>" disabled/><br>
                <label>Nome</label><input type="text" class="grande" name="txtNomeUsuarioExibicao" id="txtNomeUsuarioExibicao" value="<?php echo $usuColetaMaterialController->getUsuColetaMAterial()->getNomeUsuario(); ?>" disabled/><br>

              
            </div>
            <div style=" ">
                <label>Código</label><input type="text" class="grande" name="txtCodMaterial" id="txtCodMaterialExibicao" value="" disabled/><br>
                <label>Nome</label><input type="text" class="grande" name="txtNomeMaterial" id="txtNomeMaterialExibicao" value="" disabled/><br>

                <select id="txtCodMaterial" name="txtCodMaterial" onchange="recuperarEcopontoMaterial('http://localhost/ecolog/src/util/selecionarEcopontoMaterialAjax.php', 'codMaterial=' + this.value, 'txtCodMaterialExibicao', 'txtNomeMaterialExibicao')"> 

                    <option>Selecione o Material</option>

                </select>
            </div>
        </div>
        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">

        <br><br>
        <table id="listaEcopontos">
            <caption>Lista de Ecopontos</caption>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Material</th>
                    <th>Tipo Material</th>
                    <th colspan="2">Ação</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>    
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroEcoponto">Voltar</a>
</section>