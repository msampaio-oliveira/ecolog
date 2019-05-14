<?php
$materialController = new Controller\MaterialController($conection);
$categoriaDAO = new Model\CategoriaDAO($conection);
$categorias = json_decode($categoriaDAO->selectAll(), true);

?>
<section class="<?php echo $materialController->getLista(); ?>">
    <table>
        <caption>Lista de Usuarios</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $materialController->listarMateriais();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroMaterial&acao=1'" value="Novo">
</section>

<section class="<?php echo $materialController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Material</h4>
        <input type="hidden" name="txtCodMaterial" id="txtCodMaterial" value="<?php echo $materialController->getMaterial()->getCodMaterial(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $materialController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtNomeMaterial" id="txtNomeMaterial" value="<?php echo $materialController->getMaterial()->getNomeMaterial(); ?>" onblur="verificaMaterial('<?php echo _URLBASE_.'materialAjax.php'?>', 'nomeMaterial=' + this.value)" required/><br>


        <label>Descrição</label><input type="text" class="grande" name="txtDescMaterial" id="txtDescMaterial" value="<?php echo $materialController->getMaterial()->getDescMaterial(); ?>" required/><br>

        <label>Tipo</label>
        <select class="grande" name="txtCodCategoria">
            <?php
                        
            foreach ($categorias as $categoria) {
                $selected = "";
                if ($categoria[0] == $materialController->getMaterial()->getCodCategoria()) {
                    $selected = "selected";
                }

                echo "<option value = $categoria[0] $selected >$categoria[1]</option>";
            }
            ?>

        </select><br>
        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroMaterial">Voltar</a>
</section>

