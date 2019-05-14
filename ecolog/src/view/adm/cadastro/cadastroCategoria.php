<?php
$categoriaController = new Controller\CategoriaController($conection);
?>
<section class="<?php echo $categoriaController->getLista(); ?>">
    <table>
        <caption>Lista de Categorias</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $categoriaController->listarCategorias();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroCategoria&acao=1'" value="Novo">
</section>

<section class="<?php echo $categoriaController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Categoria</h4>
        <input type="hidden" name="txtCodCategoria" id="txtCodCategoria" value="<?php echo $categoriaController->getCategoria()->getCodCategoria(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $categoriaController->getAcaoGET(); ?>" >

        <label>Nome</label><input type="text" class="grande" name="txtNomeCategoria" id="txtNomeCategoria" value="<?php echo $categoriaController->getCategoria()->getNomeCategoria(); ?>" onblur="verificaCategoria('<?php echo _URLBASE_.'categoriaAjax.php'?>', 'nomeCategoria=' + this.value)" required/><br>

        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroCategoria">Voltar</a>
</section>


