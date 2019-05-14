<?php
$contatoController = new Controller\ContatoController($conection);

$tipoContatoDAO = new Model\TipoContatoDAO($conection);
$tiposContato = json_decode($tipoContatoDAO->selectAll(), true);

$usuarioDAO = new Model\UsuarioDAO($conection);
$usuarios = json_decode($usuarioDAO->selectAll(), true);

?>
<section class="<?php echo $contatoController->getLista(); ?>">
    <table>
        <caption>Lista de Usuarios</caption>
        <thead>
            <tr>
                <th>Código</th>
                <th>Contato</th>
                <th>Tipo Contato</th>
                <th>Usuário</th>
                <th colspan="2">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $contatoController->listarContatos();
            ?>
        </tbody>
    </table>    
    <input class="button" type="button" onclick="window.location = 'index.php?area=adm&folder=cadastro&page=cadastroContato&acao=1'" value="Novo">
</section>

<section class="<?php echo $contatoController->getFomulario(); ?>">
    <form method="POST" action="">
        <h4 class="cadCat">Cadastro de Contato</h4>
        <input type="hidden" name="txtCodContato" id="txtCodContato" value="<?php echo $contatoController->getContato()->getCodContato(); ?>">
        <input type="hidden" name="txtAcao" id="txtAcao" value="<?php echo $contatoController->getAcaoGET(); ?>" >

        <label>Contato</label><input type="text" class="grande" name="txtContato" id="txtContato" value="<?php echo $contatoController->getContato()->getContato(); ?>" onblur="verificaContato('<?php echo _URLBASE_.'contatoAjax.php'?>', 'contato=' + this.value)" required/><br>

        <label>Usuário</label>
        <select class="grande" name="txtCodUsuario">
            <?php
                        
            foreach ($usuarios as $usuario) {
                $selected = "";
                if ($usuario[0] == $contatoController->getContato()->getCodUsuario()) {
                    $selected = "selected";
                }

                echo "<option value = $usuario[0] $selected >$usuario[1]</option>";
            }
            ?>

        </select><br>
        
        <label>Tipo Contato</label>
        <select class="grande" name="txtCodTipoContato">
            <?php
                        
            foreach ($tiposContato as $tipoContato) {
                $selected = "";
                if ($tipoContato[0] == $contatoController->getContato()->getCodTipoContato()) {
                    $selected = "selected";
                }

                echo "<option value = $tipoContato[0] $selected >$tipoContato[1]</option>";
            }
            ?>

        </select><br>
        <label> </label><input class="buttonCancel" type="reset" value="Limpar"><input class="button"  type="submit" value="Enviar">
    </form>
    <br>
    <br>
    <br>
    <br>
    <a href="index.php?area=adm&folder=cadastro&page=cadastroContato">Voltar</a>
</section>

